<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\SkillService;


class SkillController extends Controller
{
    protected $skillservice;
    public function __construct(SkillService $skillservice) {
        $this->skillservice = $skillservice;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $skills = Skill::paginate(7);

        return view('admin/pages/skill', compact('skills'))->with('i', (request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin/pages/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSkillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkillRequest $request)
    {
        //
        $data = $request->all();

        try {
            $result = $this->skillservice->addNewSkill($data);
            if ($result == null) {
                return redirect()->route('skill.create')->with(["message"=>"Tên Skill bị trùng"]);
            } else {
                return redirect()->route('skill.index')->with(["message"=>"Tạo Skill mới thành công"]);
            }
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('skill.create')->with(["message"=>$e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->route('skill.create')->with(["message"=>$e->getMessage()]);
        }


    }

    public function updateSkill(Request $request) {
        $this->skillservice->updateSkill($request);
        return response()->json(['response', 'true']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        //
        return view('admin/pages/edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSkillRequest  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        //

        try {
            $result = $this->skillservice->editSkill($request->all, $skill);
            if ($result == null) {
                return redirect()->route('skill.edit', $request->id)->with(["message"=>"Tên Skill bị trùng"]);
            } else {
                return redirect()->route('skill.index')->with(["message"=>"Update skill thành công"]);
            }
        } catch (\InvalidArgumentException $e) {
            return redirect()->route('skill.edit', $request->id)->with(["message"=>$e->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->route('skill.edit', $request->id)->with(["message"=>$e->getMessage()]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        //
        $skill->delete();
        return redirect()->route('skill.index');
    }
}
