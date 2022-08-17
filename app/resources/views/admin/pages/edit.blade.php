@extends('admin.index')

@section('content')

<div class="contaier">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Sửa Skill</h3>
                </div>

                <div class="col-md-6">
                    <a href="{{route('skill.index')}}" class="btn btn-primary float-end">Danh sách skill</a>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-danger">
                    {{session()->get('message')}}

                </div>
            @endif
        </div>

        <div class="card-body">
            <form action="{{route('skill.update', $skill->id)}}" method="post">
                @csrf <!-- {{ csrf_field() }} -->
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Tên skill</strong>
                            <input value="{{session()->has('oldSkill')? session()->get('oldSkill') : $skill->skill_name}}" type="text" name="skill_name" class='form-control' placeholder="Nhập tên skill">
                            <input value="{{$skill->id}}" type="hidden" name="id" >
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Cập Nhật</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
