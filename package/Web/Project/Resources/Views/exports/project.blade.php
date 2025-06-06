@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection
@section('content')



    <style>
        @font-face {
            font-family: 'iransans';
            src: url('{{ public_path("fonts/iransans/IRANSansWebFaNum.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'iransans';
            direction: rtl;
            text-align: right;
        }
    </style>

    <p>سلام، این یک تست فارسی است.</p>



    <p>سلام، این یک تست فارسی است.</p>


    <h1>پروژه: {{ $project->name }}</h1>

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
