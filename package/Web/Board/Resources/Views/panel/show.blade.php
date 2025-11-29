@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="برد ها">برد ها</a></li>
@endsection

@section('content')

    <div class="main-content">
        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>عنوان</th>
                    <th>نام پروژه</th>
                    <th>قابلیت مشاهده</th>
                    <th>ترتیب نمایش</th>
                </tr>
                </thead>
                <tbody>
                    <tr role="row">
                        <td>{{$board->name}}</td>
                        <td>{{$board->project->name}}</td>
                        <td>@lang($board->visibility)</td>
                        <td>{{$board->position}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection
