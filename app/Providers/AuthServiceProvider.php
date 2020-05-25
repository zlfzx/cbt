<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-kelas', function($user) {
            return count(array_intersect(['admin'], $user->roles));
        });

        Gate::define('manage-mapel', function($user) {
            return count(array_intersect(['admin'], $user->roles));
        });

        Gate::define('manage-siswa', function($user) {
            return count(array_intersect(['admin'], $user->roles));
        });

        Gate::define('manage-paket', function($user) {
            return count(array_intersect(['admin', 'petugas_soal'], $user->roles));
        });

        Gate::define('manage-soal', function($user) {
            return count(array_intersect(['admin', 'petugas_soal'], $user->roles));
        });

        Gate::define('manage-ujian', function($user) {
            return count(array_intersect(['admin', 'petugas_ujian'], $user->roles));
        });

        Gate::define('manage-pengaturan', function($user) {
            return count(array_intersect(['admin'], $user->roles));
        });
    }
}
