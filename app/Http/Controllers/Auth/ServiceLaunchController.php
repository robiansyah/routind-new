<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ServiceLaunch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceLaunchController extends Controller
{
    /**
     * Send the signed-in user to a satellite app with a fresh one-minute token.
     */
    public function __invoke(Request $request, string $service, ServiceLaunch $launcher): RedirectResponse
    {
        $user = $request->user();

        abort_unless($launcher->canLaunch($user, $service), 403, $service === 'coretax'
            ? 'Akses Pro Simulator membutuhkan paket yang masih aktif.'
            : 'Akun Anda belum terdaftar di layanan ini.');

        return redirect()->away($launcher->launchUrl($user, $service));
    }
}
