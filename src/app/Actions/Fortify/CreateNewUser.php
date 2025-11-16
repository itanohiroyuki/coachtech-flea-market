<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest; // ← ここを追加

use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    /**
     * 新規ユーザーを登録する
     *
     * @param  array<string, mixed>  $input
     */
    public function create(array $input): User
    {
        // ✅ RegisterRequest のルールを適用して検証
        $request = new RegisterRequest();
        $validator = validator($input, $request->rules(), $request->messages());
        $validator->validate();

        // ✅ バリデーションを通過したらユーザー作成
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
