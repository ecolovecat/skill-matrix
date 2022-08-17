@extends('admin.index')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Quản người dùng</h3>
                    </div>

                    <div class="col-md-6">
                        <a href="{{route('user.create')}}" class="btn btn-primary float-end">Thêm người dùng</a>
                    </div>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
            <div class="card-body">

                <table class="table table-bordered">
                    <thead class="">
                    <tr>
                        <th>STT</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Thao Tác</th>
                    </tr>
                    </thead>

                    <tbody >
                    @foreach ($users as $user) {
                    <tr >
                        <td>{{$loop->index+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <form action="{{route('user.destroy', $user->id)}}" method="post">
                                <a href="{{route('user.edit', $user->id)}}" class="btn btn-info">Sửa</a>
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



@endsection()
