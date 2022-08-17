

@extends('admin.index')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Quản lý Skill</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('skill.create')}}" class="btn btn-primary float-end">Thêm mới</a>
                    </div>
                </div>

            </div>
            <div class="card-body">

                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th>STT</th>
                            <th>Tên Skill</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>

                    <tbody >
                        @foreach ($skills as $skill) {
                            <tr >
                                <td>{{++$i}}</td>
                                <td>{{$skill->skill_name}}</td>
                                <td>
                                    <form action="{{route('skill.destroy', $skill->id)}}" method="post">
                                        <a href="{{route('skill.edit', $skill->id)}}" class="btn btn-info">Sửa</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        }
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
