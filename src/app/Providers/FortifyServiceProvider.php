<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use Laravel\Fortify\Http\Requests\RegisterRequest as FortifyRegisterRequest;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        /**
         * 会員登録処理（ユーザー作成）
         */
        Fortify::createUsersUsing(CreateNewUser::class);

        /**
         * 会員登録画面
         */
        Fortify::registerView(function () {
            return view('auth.register');
        });

        /**
         * ログイン画面
         */
        Fortify::loginView(function () {
            return view('auth.login');
        });

        /**
         * ログイン試行制限（1分間に10回まで）
         */
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;
            return Limit::perMinute(10)->by($email . $request->ip());
        });

        /**
         * 独自FormRequestをFortifyに差し替え
         */
        $this->app->bind(FortifyLoginRequest::class, LoginRequest::class);
    }
}
