
@extends('admin.index')

@section('content')

    <div class="contaier">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Sửa thông tin người dùng</h3>
                    </div>

                    <div class="col-md-6">
                        <a href="{{route('user.index')}}" class="btn btn-primary float-end">Danh sách người dùng</a>
                    </div>
                </div>

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>

                @endif


            </div>

            <div class="card-body">
                <form action="{{route('user.update', $user->id)}}" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    @method('put')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Tên người dùng</strong>
                                <input type="text" name="name" class='form-control'   value="{{session()->has("oldName") ? session()->get('oldName') : $user->name}}" placeholder="Nhập tên người dùng">
                                <input type="hidden" name="oldname" class='form-control'   value="{{$user->name}}">
                                <input type="email" name="email" class='form-control' value="{{$user->email}}" placeholder="Nhập gmail">
                                <input type="hidden" name="oldemail" class='form-control' value="{{$user->email}}">
                                <input type="hidden" name="id" class='form-control' value="{{$user->id}}">

                            </div>
                            <button type="submit" class="btn btn-success mt-2">Lưu</button>
                        </div>

                </form>
            </div>
        </div>
    </div>

@endsection
