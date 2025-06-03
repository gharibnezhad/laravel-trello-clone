@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection

@section('content')

    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="courses.html">لیست پروژه ها</a>
                <a class="tab__item" href="approved.html">پروژه های تایید شده</a>
                <a class="tab__item" href="new-course.html">پروژه های تایید نشده</a>
                <a class="tab__item" href="{{route('projects.create')}}">ایجاد پروژه جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی پروژه">
                        <div class="t-header-search-content ">
                            <input type="text" class="text" placeholder="نام پروژه">
                            <input type="text" class="text" placeholder="ردیف">
                            <input type="text" class="text" placeholder="قیمت">
                            <input type="text" class="text" placeholder="نام مدرس">
                            <input type="text" class="text margin-bottom-20" placeholder="دسته بندی">
                            <btutton class="btn btn-webamooz_net">جستجو</btutton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table__box">
            <table class="table">

              <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>نام</th>
                    <th>نام انگلیسی</th>
                    <th>دسته بندی</th>
                    <th>مالک پروژه</th>
                    <th>توضیجات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($projects as $project)
                    <tr role="row">
                        <td><a href="">{{$project->name}}</a></td>
                        <td><a href="">{{$project->slug}}</a></td>
                        <td>{{$project->category->title}}</td>
                        <td>
                        {{ $project->users->first() ? $project->users->first()->name : '-' }}
                        </td>
                        <td>{{$project->description}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
