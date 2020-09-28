<?php

namespace App\Providers;

use App\Models\Board;
use App\Policies\BoardPolicy;
use App\Policies\PostPolicy;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
//         'App\Model\Board' => 'App\Policies\BoardPolicy',
        Post::class => PostPolicy::class,
        Board::class => BoardPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

//        Gate::define('update', function ($user, $post) {
////            return $user->id == $post->user_id;
//            return true;
//        });
//        Gate::resource('Board', 'Board');
        //Gate::define('update-post', 'App\Policies\BoardPolicy@update');


//        Passport::tokensExpireIn(now()->addDays(15));
//
//        Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
