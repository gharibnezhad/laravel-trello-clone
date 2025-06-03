@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="برد ها">برد ها</a></li>
@endsection

@section('content')

    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="courses.html">لیست برد ها</a>
                <a class="tab__item" href="approved.html">برد های تایید شده</a>
                <a class="tab__item" href="new-course.html">برد های تایید نشده</a>
                <a class="tab__item" href="{{route('boards.create')}}">ایجاد برد جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی برد">
                        <div class="t-header-search-content ">
                            <input type="text" class="text" placeholder="نام برد">
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
                    <th>عنوان</th>
                    <th>نام پروژه</th>
                    <th>قابلیت مشاهده</th>
                    <th>ترتیب نمایش</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($boards as $board)
                    <tr role="row">
                        <td><a href="">{{$board->name}}</a></td>
                        <td><a href="">{{$board->project->name}}</a></td>
                        <td>@lang($board->visibility)</td>
                        <td>{{$board->order}}</td>
                        <td>
                            <a href="" class="item-delete mlg-15" title="حذف"></a>
                            <a href="" class="item-reject mlg-15" title="رد"></a>
                            <a href="" class="item-lock mlg-15" title="قفل دوره"></a>
                            <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="" class="item-confirm mlg-15" title="تایید"></a>
                            <a href="" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
