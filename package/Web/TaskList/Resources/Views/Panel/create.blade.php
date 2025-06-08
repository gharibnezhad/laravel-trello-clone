@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="تسک لیست ها">تسک لیست ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ایجاد تسک لیست جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('taskLists.store')}}" method="post" class="padding-30">
                    @csrf
                    <x-input type="text" name="name"  class="text" placeholder="عنوان" />
                    <x-input type="number" name="order" class="text text-left " placeholder="ترتیب نمایش"/>
                    <x-select name="board_id" >
                        <option value="">انتخاب برد</option>
                        @foreach($boards as $key => $value)

                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </x-select>

                    <button class="btn btn-webamooz_net">ایجاد تسک لیست</button>
                </form>
            </div>
        </div>
    </div>
@endsection
