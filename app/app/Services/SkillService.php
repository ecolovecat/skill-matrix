<?php

namespace App\Services;
use App\Repositories\SkillRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use app\Models\User;
use app\Models\Skill;


class SkillService
{
    protected $skillRepository;

    public function __construct(SkillRepository $skillRepository) {
        $this->skillRepository = $skillRepository;
    }

    public function addNewSkill($data) {
        $validator = Validator::make($data, [
            'skill_name' => 'required',
        ]);
        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }


        $skill = Skill::where('skill_name', $data['skill_name'])->first();
        if ($skill == null) {
            $skill = $this->skillRepository->create($data);
            $this->skillRepository->addDefaultSkillValueForUser($skill);
            return $skill;
        }
        return null;
    }

    public function editSkill($data,$skill) {
        $check_skill = Skill::where('skill_name',$data['skill_name'])->first();
        if ($check_skill == null) {
            $this->skillRepository->updateSkill($data,$skill);
        } else return null;
    }

    public function updateSkill($data) {
        $this->skillRepository->update($data);
    }

}
