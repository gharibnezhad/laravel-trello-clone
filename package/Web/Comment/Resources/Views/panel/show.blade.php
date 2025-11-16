@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="کامنت ها">کامنت ها</a></li>
@endsection

@section('content')
    <div class="main-content">
        <div class="table__box">
            <h3>کامنت اصلی</h3>
            <table class="table">
                <thead>
                <tr class="title-row">
                    <th>شناسه</th>
                    <th>متن</th>
                    <th>نوع</th>
                    <th>کاربر</th>
                    <th>شناسه نوع</th>
                    <th>تاریخ ارسال</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->body }}</td>
                    <td>{{ class_basename($comment->comment_type) }}</td>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ $comment->comment_id }}</td>
                    <td>{{ $comment->created_at }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        @if($comment->child->count() > 0)
            <div class="table__box mt-3">
                <h3>پاسخ‌ها</h3>
                <table class="table">
                    <thead>
                    <tr class="title-row">
                        <th>شناسه</th>
                        <th>متن</th>
                        <th>کاربر پاسخ‌دهنده</th>
                        <th>تاریخ پاسخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comment->child as $reply)
                        <tr>
                            <td>{{ $reply->id }}</td>
                            <td>{{ $reply->body }}</td>
                            <td>{{ $reply->user->name }}</td>
                            <td>{{ $reply->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info mt-3">هیچ پاسخی برای این کامنت ثبت نشده است.</div>
        @endif
    </div>
@endsection
