@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection

@section('content')

    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{route('tasks.create')}}">ایجاد تسک جدید</a>
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
                    <th>توضیجات</th>
                    <th>اولویت</th>
                    <th>زمان تحویل</th>
                    <th>وضعیت تسک لیست</th>
                    <th>ترتیب نمایش</th>
                    <th>تعداد اعضا</th>
                    <th>افزودن عضو</th>
                    <th>مشاهده اعضا</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($tasks as $task)
                    <tr role="row">
                        <td>{{$task->title}}</td>
                        <td>{{$task->taskList->board->name}}</td>
                        <td>{{$task->description}}</td>
                        <td>{{$task->priority}}</td>
                        <td>{{$task->due_time}}</td>
                        <td>{{$task->taskList->name}}</td>
                        <td>{{$task->order}}</td>
                        <td>{{$task->users->count()}}</td>
                        <td><a href="{{route('createMemberToTask',$task->id)}}"
                               class="item-answer mlg-15" title="اضافه کردن اعضا"></a></td>
                        <td><a href="{{route('membersTask',$task->id)}}"
                               class="item-eye mlg-15" title="مشاهده اعضا"></a></td>
                        <td>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="item-delete mlg-15" title="حذف" onclick="return confirm('آیا مطمئن هستید؟')"></button>
                            </form>
                            <a href="{{route('tasks.edit',$task->id)}}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection

