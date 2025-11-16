@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="برد ها">برد ها</a></li>
@endsection

@section('content')

    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{route('boards.index')}}">لیست برد ها</a>
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
                    <th>تعداد اعضا</th>
                    <th>افزودن عضو</th>
                    <th>مشاهده اعضا</th>
                    <th>قابلیت مشاهده</th>
                    <th>ترتیب نمایش</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($boards as $board)
                    <tr role="row">
                        <td>{{$board->name}}</td>
                        <td>{{$board->project->name}}</td>
                        <td>{{$board->users->count()}}</td>
                        <td><a href="{{route('createMemberToBoard',$board->id)}}" class="item-answer mlg-15" title="اضافه کردن اعضا"></a></td>
                        <td><a href="{{route('membersBoard',$board->id)}}" class="item-eye mlg-15" title="مشاهده اعضا"></a></td>
                        <td>@lang($board->visibility)</td>
                        <td>{{$board->order}}</td>
                        <td>
                            <form action="{{ route('boards.destroy', $board->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="item-delete mlg-15" title="حذف" onclick="return confirm('آیا مطمئن هستید؟')"></button>
                            </form>
                            <a href="{{route('boards.show',$board->id)}}" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="{{route('boards.edit',$board->id)}}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
