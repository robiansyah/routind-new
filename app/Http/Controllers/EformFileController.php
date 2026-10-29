<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Question;
use App\Models\Spt;
use App\Models\Spt1770induk;
use App\Models\Spt1771induk;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Tax documents students attach to an SPT. They hold personal tax data, so they are
 * kept outside public/ and only the student, the class's teachers and admins can open them.
 */
class EformFileController extends Controller
{
    /** Where new uploads go, on the private "local" disk (storage/app/eform). */
    public const DIRECTORY = 'eform';

    /** The attachment columns on the SPT "induk" tables. */
    public const FIELDS = [
        'file_laporan', 'file_rekapitulasi', 'file_nominatif', 'file_but',
        'file_migas', 'file_perbandingan', 'file_bupot', 'file_lainnya',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Spt $spt, string $field): BinaryFileResponse
    {
        abort_unless(in_array($field, self::FIELDS, true), 404);
        abort_unless($this->canView(auth()->user(), $spt), 403);

        $induk = Spt1771induk::where('spt_id', $spt->id)->first()
            ?? Spt1770induk::where('spt_id', $spt->id)->first();

        $name = $induk ? basename((string) $induk->{$field}) : '';
        abort_if($name === '', 404);

        $path = self::locate($name);
        abort_if($path === null, 404);

        return response()->file($path, ['Content-Type' => 'application/pdf']);
    }

    /**
     * Store an uploaded attachment privately under a random name and return that name.
     */
    public static function store(UploadedFile $file): string
    {
        $name = Str::random(40).'.pdf';
        $file->storeAs(self::DIRECTORY, $name, 'local');

        return $name;
    }

    /**
     * The file's path on disk. Files uploaded before this change may still sit in
     * public/uploads until `php artisan eform:secure-uploads` has moved them.
     */
    public static function locate(string $name): ?string
    {
        $private = Storage::disk('local')->path(self::DIRECTORY.'/'.$name);
        if (is_file($private)) {
            return $private;
        }

        $legacy = public_path('uploads/'.$name);

        return is_file($legacy) ? $legacy : null;
    }

    private function canView(User $user, Spt $spt): bool
    {
        if ((int) $spt->user_id === (int) $user->id || $user->hasRole('admin')) {
            return true;
        }

        $classId = Question::whereKey($spt->question_id)->value('class_id');

        return $classId !== null && Kelas::whereKey($classId)
            ->where(fn ($query) => $query->where('user_id', $user->id)->orWhere('co_id', $user->id))
            ->exists();
    }
}
