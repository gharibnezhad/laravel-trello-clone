@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="دسته بندی ها">دسته بندی ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ویرایش دسته بندی</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('categories.update',$category->id)}}" method="post" class="padding-30">
                    @csrf
                    @method('PATCH')
                        <input type="text" name="title" value="{{$category->title}}" placeholder="نام دسته بندی" class="text" required>
                        <input type="text" name="slug" placeholder="نام انگلیسی دسته بندی" value="{{$category->slug}}" class="text" required>
                        <button class="btn btn-webamooz_net">اضافه کردن</button>
                </form>
            </div>
        </div>
    </div>
@endsection
