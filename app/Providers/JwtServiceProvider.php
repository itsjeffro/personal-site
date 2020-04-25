<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Game\Auth\JwtProvider;
use Lcobucci\JWT\Builder as JWTBuilder;
use Lcobucci\JWT\Parser as JWTParser;

class JwtServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(JwtProvider::class, function ($app) {
            return new JwtProvider(
                new JWTBuilder(),
                new JWTParser(),
                config('jwt.secret'),
                config('jwt.algo'),
                config('jwt.keys')
            );
        });
    }
}