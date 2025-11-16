@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ویرایش پروژه</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('projects.update',$project->id)}}" method="post" class="padding-30" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <x-input type="text" name="name"  class="text" value="{{$project->name}}" placeholder="نام پروژه" />
                    <x-input type="text" name="slug" class="text text-left" value="{{$project->slug}}" placeholder="نام انگلیسی پروژه" />
                    <x-select name="category_id" required>
                        <option value="">دسته بندی</option>
                        @foreach($categories as $category)

                        <option value="{{$category->id}}" @if($category->id == $project->category_id) selected @endif>{{$category->title}}</option>
                        @endforeach
                    </x-select>
                    <x-select name="visibility">
                        <option value="">قابلیت مشاهده پروژه</option>
                        <option value="public" {{ old('visibility',$project->visibility) === 'public' ? 'selected' : '' }}>Public</option>
                        <option value="private" {{ old('visibility',$project->visibility) === 'private' ? 'selected' : '' }}>Private</option>
                    </x-select>
                    <x-file placeholder="آپلود فایل" name="file"  :value="$project->media" />
                    <x-textarea  placeholder="توضیحات پروژه" name="description" value="{{$project->description}}"/>

                    <button class="btn btn-webamooz_net">ایجاد پروژه</button>
                </form>
            </div>
        </div>
    </div>
@endsection
