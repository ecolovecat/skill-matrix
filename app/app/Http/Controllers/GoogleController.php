<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Skill;

use Auth;

class GoogleController extends Controller
{
    //
    public function loginWithGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle() {

            $user = Socialite::driver('google')->stateless()->user();
            $this->createOrUpdateUser($user, 'google');
            return redirect()->route('login-success');

    }

    private function createOrUpdateUser($data, $provider) {
        $user = User::where('email', $data->email)->first();
        if ($user) {
            $user->update([
                'provider' => $provider,
                'provider_id' => $data->id,
                'avatar' => $data->avatar,
            ]);
        } else {
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'provider' => $provider,
                'provider_id' => $data->id,
                'avatar' => $data->avatar,
            ]);

            $skills = Skill::all();
            foreach ($skills as $skill) {
                $skill->user()->attach($user->id);
            }
        }

        Auth::login($user);
    }
}
