<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Subjects::class => SubjectsPolicy::class,
        Student::class => StudentPolicy::class,
        Role::class => RolePolicy::class,
        ProgrammeUser::class => ProgrammeUser::class,
        Programme::class => ProgrammePolicy::class,
        Presences::class =>  PresencesPolicy::class,
        Opinion::class => OpinionPolicy::class,
        Kitbsd::class => KitbsdPolicy::class,
        Group::class => GroupPolicy::class,
        Classroom::class => ClassroomPolicy::class,
        Dashboard::class => DashboardPolicy::class,
        Dashboardp::class => DashboardpPolicy::class,
        Dashboardt::class => DashboardtPolicy::class,


    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-admin', function(User $user) {
            return $user->isAdmin();
        });

        Gate::define('view-parent', function(User $user) {
            return $user->isParent();
        });

        Gate::define('view-professeur', function(User $user) {
            return $user->isProfesseur();
        });
    }
}
