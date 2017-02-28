<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('admin', function ($user) {
            return $user->role === 'admin';
        });

        $gate->define('view-course', function ($user, $course) {
            return $user->courses->contains($course)
                || $course->teachers->contains($user)
                || $user->role === 'admin';
        });

        $gate->define('manage-course-contents', function ($user, $course) {
            return $user->role === 'admin' || ($user->role === 'teacher' && $course->teachers->contains($user));
        });

        $gate->define('edit-question', function ($user, $question) {
            return $user->id === $question->user_id;
        });

        $gate->define('edit-answer', function ($user, $answer) {
            return $user->id === $answer->user_id;
        });

        $gate->define('edit-profile', function ($user, $userToEdit) {
            return $user->id === $userToEdit->id;
        });
    }
}
