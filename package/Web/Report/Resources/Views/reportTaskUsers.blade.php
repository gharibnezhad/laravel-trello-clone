@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="گزارش تسک کاربران"> گزارش تسک کاربران </a></li>
@endsection

@section('content')

    <div class="main-content">

        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>نام کاربر</th>
                    <th>ایمیل</th>
                    <th>عنوان تسک</th>
                    <th>وضعیت</th>
                    <th>زمان شروع</th>
                    <th>زمان تحویل</th>
                    <th>تعداد تسک</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    @if($user->tasks->count() > 0)
                        @foreach($user->tasks as $task)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->taskList->name }}</td>
                                <td>{{ $task->created_at }}</td>
                                <td>{{ $task->due_time }}</td>
                                <td>{{ $user->tasks->count() }}</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
                </tbody>


            </table>
        </div>
    </div>

@endsection

