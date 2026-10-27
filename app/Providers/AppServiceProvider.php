<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Opcodes\LogViewer\Facades\LogViewer;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Blade::directive('money', function ( $expression ) { return "<?php echo number_format($expression,0,',','.'); ?>"; });
        Gate::define('viewPulse', function (User $user) {
            return $user->hasRole('admin');
        });
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        LogViewer::auth(function ($request) {
            return $request->user()
                && in_array($request->user()->email, [
                    'admin@routind.com',
//                    'instruktur@routind.com',
                ]);
        });

        Validator::extend('no_xss', function ($attribute, $value, $parameters, $validator) {
            return !preg_match('/(<script|javascript:|onerror|alert\(|document\.)/i', $value);
        });
    }
}
