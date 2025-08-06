@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="لاگ تسک ها">لاگ تسک ها</a></li>
@endsection

@section('content')

    <div class="main-content">
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی تسک">
                        <div class="t-header-search-content ">
                            <input type="text" class="text" placeholder="نام پروژه">
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
                    <th>عنوان تسک</th>
                    <th>توضیجات</th>
                    <th>وضعیت عملکرد</th>
                    <th>زمان اجرا</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($taskActivities as $task)
                    <tr role="row">
                        <td>{{$task->task->name}}</td>
                        <td>{{$task->description}}</td>
                        <td>{{$task->action}}</td>
                        <td>{{$task->created_at}}</td>
                        <td>
                            <form action="{{ route('taskActivities.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="item-delete mlg-15" title="حذف" onclick="return confirm('آیا مطمئن هستید؟')"></button>
                            </form>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection

