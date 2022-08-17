<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use app\Models\User;





class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {

        $this->userRepository = $userRepository;
    }

    public function addNewUser($data) {
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'bail|required|email'
        ]);
        $user = null;
        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
            return $user;

        }


        $email = User::where('email', $data['email'])->first();
        if ($email == null) {
            $user = $this->userRepository->create($data);
            $this->userRepository->addDefaultSkillValueForUser($user);
        }
        return $user;


    }

    public function updateUserWithId($data) {
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'bail|required|email'
        ]);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
            return $user;
        }

        $email = $this->userRepository->getExistEmail($data['email']);

        if ($email == null) {
            return $this->userRepository->updateWithId($data);
        } else return null;
    }

    public function deleteUser(User $user) {
        $this->userRepository->deleteUser($user);
    }
}
