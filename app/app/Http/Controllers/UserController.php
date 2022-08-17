<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use app\Models\User;
use app\Models\Skill;

use App\Services\UserService;




class UserController extends Controller
{


    protected $userservice;

    public function __construct(UserService $userService) {
        $this->userservice = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::paginate(5);
        return view('admin/edit-user/index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/edit-user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

//        dd($this->userservice);

        $data = $request->all();

            try {
                $result = $this->userservice->addNewUser($data);
                if ($result) {
                    return redirect()->route('user.index')->with(["message"=>"Tạo người dùng mới thành công", $result]);
                } else {
                    return redirect()->route('user.create')->with(["nameOld"=>$request->name, "message"=>"Gmail đã được sử dụng"]);

                }
            } catch (\InvalidArgumentException $e) {
                return redirect()->route('user.create')->with(["message"=>$e->getMessage()]);
            } catch (\Exception $e) {
                return redirect()->route('user.create')->with(["nameOld"=>$request->name, "message"=>$e->getMessage()]);
            }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('admin/edit-user/edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //

        try {
            $result = $this->userservice->updateUserWithId($request->all());
            if ($result == null) {
                return redirect()->route('user.edit')->with(["message"=>"Tên email đã bị trùng", "oldName"=>$request->name]);
            } else return redirect()->route('user.index')->with(["message"=>"Cập nhật thông tin thành công"]);
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('user.edit', $request->id)->with(["message"=>$e->getMessage(), "oldName"=>$request->name]);
        } catch (\Exception $e) {
            return redirect()->route('user.edit', $request->id)->with(["message"=>$e->getMessage(), "oldName"=>$request->name]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $this->userservice->deleteUser($user);
        return redirect()->route('user.index');

    }
}
