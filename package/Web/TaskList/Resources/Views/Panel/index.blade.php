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
                        <td>{{$taskList->board->name}}</td>
                        <td>{{$taskList->position}}</td>
                        <td>
                            <form action="{{ route('taskLists.destroy', $taskList->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="item-delete mlg-15" title="حذف" onclick="return confirm('آیا مطمئن هستید؟')"></button>
                            </form>
                            <a href="{{route('taskLists.edit',$taskList->id)}}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            {{$taskLists->links()}}
        </div>
    </div>

@endsection

