@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ویرایش پروژه</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('projects.update',$project->id)}}" method="post" class="padding-30">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="name"  class="text" value="{{$project->name}}" placeholder="نام پروژه" required>
                    <input type="text" name="slug" class="text text-left" value="{{$project->slug}}" placeholder="نام انگلیسی پروژه" required>
                    <select name="category_id" required>
                        <option value="">دسته بندی</option>
                        @foreach($categories as $category)

                        <option value="{{$category->id}}"
                        @if($category->id == $project->category_id) selected @endif>{{$category->title}}</option>
                        @endforeach
                    </select>
                    <textarea name="description"  placeholder="توضیحات پروژه" class="text h" >{{ old('description', $project->description) }}</textarea>
                    <button class="btn btn-webamooz_net">ایجاد پروژه</button>
                </form>
            </div>
        </div>
    </div>
@endsection
