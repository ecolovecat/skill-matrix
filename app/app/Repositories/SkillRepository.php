<?php

namespace App\Repositories;
use App\Models\Skill;
use App\Models\User;


class SkillRepository
{
    protected $skill;
    public function __construct(Skill $skill) {
        $this->skill = $skill;
    }

    public function create($data) {
         return Skill::create($data);
    }

    public function addDefaultSkillValueForUser($skill) {
        $users = User::all();

        foreach ($users as $user) {
            $user->skill()->attach($skill->id);
        }
    }

    public function updateSkill($data,$skill) {
        return $skill->update($data);
    }



    public function deleteUser(User $user) {
        $user->delete();
    }

    public function update($data) {
        $user =  User::find($data->user_id);
        $oldday = $user->skill()->find($data->skill_id)->pivot->day;
        $newday = $oldday + (int)$data->day;
        $user->skill()->updateExistingPivot($data->skill_id,['level'=>$data->level, 'day'=>$newday], false);
    }


}
