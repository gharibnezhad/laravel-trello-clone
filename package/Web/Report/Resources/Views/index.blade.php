@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="گزارشات"> گزارشات </a></li>
@endsection

@section('content')

    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{route('userTask')}}">گزارش تسک کاربران</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="{{route('reports.index')}}" method="GET">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی تسک">
                        <div class="t-header-search-content ">
                            <select name="name" onchange="this.form.submit()">
                                <option disabled selected>انتخاب نام تسک لیست</option>
                                @foreach($nameTaskLists as $taskList)
                                    <option value="{{$taskList}}">{{$taskList}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active"> تعداد کل تسک ها = {{ $countTasks}} </a>
                <a class="tab__item is-active"> تعداد تسک لیست = {{ $countTasksEachTaskList}} </a>
        </div>
        </div>
        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>عنوان تسک</th>
                    <th>توضیجات</th>
                    <th>وضعیت</th>
                    <th>زمان شروع</th>
                    <th>زمان تحویل</th>
                    <th>اولویت</th>
                </tr>
                </thead>
                <tbody>

                @foreach($getTasksEachTaskLists as $task)
                    <tr role="row">
                        <td>{{$task->title}}</td>
                        <td>{{$task->description}}</td>
                        <td>{{$task->taskList->name}}</td>
                        <td>{{$task->created_at}}</td>
                        <td>{{$task->due_time}}</td>
                        <td>{{$task->priority}}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection

