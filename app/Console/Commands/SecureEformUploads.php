<?php

namespace App\Console\Commands;

use App\Http\Controllers\EformFileController;
use App\Models\Spt1770induk;
use App\Models\Spt1771induk;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

/**
 * One-off: move SPT attachments uploaded before they were stored privately out of
 * public/uploads (where anyone could download them) into storage/app/eform.
 */
class SecureEformUploads extends Command
{
    protected $signature = 'eform:secure-uploads {--dry-run : Only report what would be moved}';

    protected $description = 'Move SPT attachments from public/uploads to private storage';

    public function handle(): int
    {
        $disk = Storage::disk('local');
        $dryRun = (bool) $this->option('dry-run');
        $moved = $missing = $already = 0;

        foreach ([Spt1771induk::class, Spt1770induk::class] as $model) {
            // Each table has its own subset of the attachment columns.
            $columns = array_values(array_intersect(
                EformFileController::FIELDS,
                Schema::getColumnListing((new $model)->getTable())
            ));

            $model::query()->select($columns)->lazy()->each(function ($row) use ($columns, $disk, $dryRun, &$moved, &$missing, &$already) {
                foreach ($columns as $column) {
                    $name = basename((string) $row->{$column});
                    if ($name === '') {
                        continue;
                    }

                    $target = EformFileController::DIRECTORY.'/'.$name;
                    if ($disk->exists($target)) {
                        $already++;
                        continue;
                    }

                    $legacy = public_path('uploads/'.$name);
                    if (! is_file($legacy)) {
                        $missing++;
                        continue;
                    }

                    if (! $dryRun) {
                        $disk->makeDirectory(EformFileController::DIRECTORY);
                        rename($legacy, $disk->path($target));
                    }
                    $moved++;
                }
            });
        }

        $this->info(($dryRun ? 'Would move' : 'Moved')." {$moved} file(s). Already private: {$already}. Not found: {$missing}.");

        return self::SUCCESS;
    }
}
