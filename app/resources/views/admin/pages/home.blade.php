@extends('admin.index')



@section('content')

    @csrf
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard <small>Statistics Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>


<!-- /.row -->

<table class="table">
    <thead>
    <tr>
    <th>STT</th>
    <th>Gmail</th>
    <th>Name</th>
    @foreach ($skills as $skill ) {
        <th>{{$skill->skill_name}}</th>
    }

    @endforeach

    </tr>
    </thead>
    <tbody>
    <tr>


        @foreach ($users as $user ) {

        <td>{{$loop->index+1}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->name}}</td>
        }


{{--{{dd($skill->user())}}--}}
    @foreach ($skills as $skill ) {

    @csrf

        <td >

            <select
                onchange="changeColor(this)"

                id="{{$user->id}}-{{$skill->id}}"
                name = "select"
                user_id="{{$user->id}}"
                skill_id="{{$skill->id}}"
{{--                onclick="consoleText('{{$user->skill()->find($skill->id)->pivot->level}}')"--}}
                class="form-select change-color" aria-label="Default select example">
                <option selected>{{$value = $user->skill()->find($skill->id)->pivot->level}}</option>
                <option value="-1">-1</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </td>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    }

    @endforeach
    </tr>
        @endforeach




    </tr>

    </tbody>
{{--    <button type="submit" class="btn btn-success mt-2">Cập Nhật</button>--}}
    </table>

<!-- /.row -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


    <script>


        var change_color = document.getElementsByClassName("change-color");
        for (i = 0; i < change_color.length; i++) {
            changeStart(change_color[i]);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function changeStart(that) {


            var value = that.value;


            switch (value) {
                case "-1":
                    color = "Magenta";
                    break;
                case "0":
                    color = "Purple";
                    break;
                case "1":
                    color = "Red";
                    break;
                case "2":
                    color = "Maroon"
                    break;
                case "3":
                    color = "Teal"
                    break;
                case "4":
                    color = "Green"
                    break;
                case "5":
                    color = "Cyan"
                    break;
                default:
                    color = "white";
                    that.style.color = "black";

            }
            that.style.backgroundColor = color;
            if (color !== "white") {
                that.style.color = "white";
            }


        }

        function changeColor(that) {

            var day = prompt("Nhập số ngày hoàn thành: ");
            var value = that.value;
            if (day !== "") {
                var user_id = that.getAttribute("user_id");
                var skill_id = that.getAttribute("skill_id");




                switch (value) {
                    case "-1":
                        color = "Magenta";
                        break;
                    case "0":
                        color = "Purple";
                        break;
                    case "1":
                        color = "Red";
                        break;
                    case "2":
                        color = "Maroon"
                        break;
                    case "3":
                        color = "Teal"
                        break;
                    case "4":
                        color = "Green"
                        break;
                    case "5":
                        color = "Cyan"
                        break;
                    default:
                        color = "white";
                        that.style.color = "black";

                }
                that.style.backgroundColor = color;
                if (color !== "white") {
                    that.style.color = "white";
                }

                var temp = user_id+"-"+skill_id;

                var level = document.getElementById(temp).value;

                $.ajax({
                    type: "put",
                    datatype: "json",
                    data: {
                        user_id:user_id,
                        skill_id:skill_id,
                        level:level,
                        day:day,
                        _token: '{{csrf_token()}}'
                    },
                    url: '{{url('update')}}',
                    success: function () {

                    },
                    error: function () {
                        alert("no")
                    }
                })
            } else {
                alert("Bạn chưa điền số ngày")
                that.value.innerHTML = value;

            }

        }
    </script>
@endsection
