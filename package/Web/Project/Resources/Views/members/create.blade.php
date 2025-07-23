@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">اضافه کردن عضو جدید به پروژه :{{$project->name}}</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('addMembersProject',$project->id)}}" method="post" class="padding-30">
                    @csrf
                    <x-select name="user_id">
                        <option value="">انتخاب نام کاربر</option>
                        @foreach($users as $user)

                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </x-select>

                    <button class="btn btn-webamooz_net">افزودن عضو جدید</button>
                </form>
            </div>
        </div>
    </div>
@endsection
