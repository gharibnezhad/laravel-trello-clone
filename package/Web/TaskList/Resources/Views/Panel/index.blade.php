@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection

@section('content')

    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{route('taskLists.create')}}">ایجاد تسک لیست جدید</a>
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
                    <th>عنوان</th>
                    <th>نام برد</th>
                    <th>ترتیب نمایش</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($taskLists as $taskList)
                    <tr role="row">
                        <td>{{$taskList->name}}</td>
                        <td><a href="">{{$taskList->board->name}}</a></td>
                        <td>{{$taskList->order}}</td>
                        <td>
                            <a href="{{route('taskLists.destroy',$taskList->id)}}" class="item-delete mlg-15" title="حذف"></a>
                            <a href="" class="item-reject mlg-15" title="رد"></a>
                            <a href="" class="item-lock mlg-15" title="قفل دوره"></a>
                            <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="" class="item-confirm mlg-15" title="تایید"></a>
                            <a href="{{route('taskLists.edit',$taskList->id)}}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection

