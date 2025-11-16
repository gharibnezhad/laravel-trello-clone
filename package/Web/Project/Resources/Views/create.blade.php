@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ایجاد پروژه جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('projects.store')}}" method="post" class="padding-30" enctype="multipart/form-data">
                    @csrf
                    <x-input type="text" name="name"  class="text" placeholder="نام پروژه" />
                    <x-input type="text" name="slug" class="text text-left " placeholder="نام انگلیسی پروژه"/>
                    <x-select name="category_id" >
                        <option value="">دسته بندی</option>
                        @foreach($categories as $category)

                        <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </x-select>
                    <x-select name="visibility" class="w-full">
                        <option value="">قابلیت مشاهده پروژه</option>
                        <option value="public" {{ old('visibility') === 'public' ? 'selected' : '' }}>Public</option>
                        <option value="private" {{ old('visibility') === 'private' ? 'selected' : '' }}>Private</option>
                    </x-select>

                    <x-file placeholder="آپلود فایل" name="file" />
                    <x-textarea name="description" placeholder="توضیحات پروژه" class="text h" value=""></x-textarea>
                    <button class="btn btn-webamooz_net">ایجاد پروژه</button>
                </form>
            </div>
        </div>
    </div>
@endsection
