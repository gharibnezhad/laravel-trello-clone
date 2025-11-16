@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="بردها">بردها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">اضافه کردن عضو جدید به برد :{{$board->name}}</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('addMembersBoard',$board->id)}}" method="post" class="padding-30">
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
