<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Comment;
use App\Policies\CommentPolicy;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * Здесь регистрируются политики, связанные с моделями.
     */
    protected $policies = [
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Этот шлюз выполняется до всех политик
        // Модератор может делать всё, не проверяя дальше
        Gate::before(function (User $user, string $ability) {
            if ($user->role === 'moderator') {
                return true;
            }
        });
    }
}
