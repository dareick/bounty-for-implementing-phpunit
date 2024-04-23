<?php

namespace App\Traits;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

trait UserTrait {
    public function createUser($name, $email, $password) {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
        return $user;
    }

    public function loginUser($email, $password) {
        $token = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ]);
        return $token;
    }

    public function deleteUser($email) {
        User::where('email', $email)->delete();
        return 'success';
    }
}