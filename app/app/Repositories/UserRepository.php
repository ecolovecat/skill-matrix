<?php

namespace App\Repositories;
use App\Models\Skill;
use App\Models\User;




class UserRepository
{

    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function create($data) {
        return User::create($data);

    }

    public function addDefaultSkillValueForUser($user) {
        $skills = Skill::all();

        foreach ($skills as $skill) {
            $skill->user()->attach($user->id);
        }
    }

    public function updateWithId($data) {
        User::where('id',$data->id)->update(["name"=>$data->name]);
    }

    public function getExistEmail($email) {
        return  User::where('email',$email)->first();
    }

    public function deleteUser(User $user) {
        $user->delete();
    }
}
