
@extends('admin.index')

@section('content')

    <div class="contaier">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Thêm User</h3>
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
                <form action="{{route('user.store')}}" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Tên người dùng</strong>
                                <input type="text" name="name" class='form-control' value="{{ session()->get('nameOld') }}" placeholder="Nhập tên người dùng">
                                <input type="email" name="email" class='form-control' placeholder="Nhập gmail">
                            </div>
                            <button type="submit" class="btn btn-success mt-2">Lưu</button>
                        </div>

                </form>
            </div>
        </div>
    </div>

@endsection
