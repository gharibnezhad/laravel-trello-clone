@extends('Project::exports.project_pdf')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection
@section('content')



    <style>
        @font-face {
            font-family: 'IRANSans';
            src: url('file://{{ public_path("fonts/iransans/ttf/IRANSansWeb(FaNum).ttf") }}') format('truetype');
        }

        body {
            font-family: 'iransans', 'DejaVu Sans', sans-serif;
            direction: rtl;
            text-align: right;
        }

    </style>

    <h1>پروژه: {{ $project->name }}</h1>
    <h1>مالک پروژه: {{ $project->users()->where('role_id',\Web\RolePermissions\Models\Role::OWNER)->first() ? $project->users()->first()->name : '_' }}</h1>
    <br>
    @foreach($project->boards as $board)
        <h2>برد: {{ $board->name }}</h2>

        @foreach($board->taskLists as $list)
            <h3>لیست: {{ $list->name }}</h3>
            <table>
                <thead>
                <tr>
                    <th>عنوان</th>
                    <th>اولویت</th>
                    <th>وضعیت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list->tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>{{ $task->status }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach
    @endforeach


@endsection
