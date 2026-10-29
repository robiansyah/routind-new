<?php

namespace App\Services;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Single sign-on to the Routind satellite apps (Exam, Coretax, LMS).
 *
 * A token is minted only when the user clicks "Launch" and expires after a minute,
 * so a leaked link (logs, browser history, Referer) is useless almost immediately.
 */
class ServiceLaunch
{
    /** Seconds a launch token stays valid. It only has to survive the redirect. */
    public const TOKEN_TTL = 60;

    /** @var array<string, array{db: string, url: string}> */
    public const SERVICES = [
        'exam' => ['db' => 'second_db', 'url' => 'https://exam.routind.com/token-login'],
        'coretax' => ['db' => 'coretax_db', 'url' => 'https://tax.routind.com/token-login'],
        'lms' => ['db' => 'lms_db', 'url' => 'https://lms.routind.com/token-login'],
    ];

    /**
     * Remember in the session which services the user has an account in, so the
     * dashboards know which Launch buttons to show. No token is stored.
     */
    public function rememberAvailableServices(Request $request, User $user): void
    {
        foreach (array_keys(self::SERVICES) as $service) {
            $request->session()->put($service, $this->isRegistered($user, $service));
            $request->session()->forget($service.'_url');
        }
    }

    /**
     * Whether the user has an account in the service. A service whose database
     * cannot be reached counts as "not registered" so it never blocks Routind.
     */
    public function isRegistered(User $user, string $service): bool
    {
        try {
            return DB::connection(self::SERVICES[$service]['db'])
                ->table('users')
                ->where('email', $user->email)
                ->exists();
        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }

    /**
     * Whether the user may open the service right now.
     */
    public function canLaunch(User $user, string $service): bool
    {
        if ($service === 'coretax' && ! $this->hasActiveCoretaxPackage($user)) {
            return false;
        }

        return $this->isRegistered($user, $service);
    }

    /**
     * Coretax (Pro Simulator) needs a package that has not expired yet.
     * Admins are exempt, matching the admin dashboard.
     */
    public function hasActiveCoretaxPackage(User $user): bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return $user->paket !== null
            && $user->end_date !== null
            && $user->end_date >= now()->toDateString();
    }

    /**
     * The service's token-login URL with a freshly minted, short-lived token.
     */
    public function launchUrl(User $user, string $service): string
    {
        $issuedAt = time();

        $token = JWT::encode([
            'iss' => config('app.url'),
            'sub' => $user->email,
            'iat' => $issuedAt,
            'exp' => $issuedAt + self::TOKEN_TTL,
        ], config('app.key'), 'HS256');

        return self::SERVICES[$service]['url'].'?'.http_build_query(['token' => $token]);
    }
}
