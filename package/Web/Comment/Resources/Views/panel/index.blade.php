@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="کامنت ها">کامنت ها</a></li>
@endsection

@section('content')

    <div class="main-content">

        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>متن</th>
                    <th>کاربر</th>
                    <th>نوع</th>
                    <th>شناسه نوع</th>
                    <th>زمان ارسال</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($comments as $comment)
                    <tr role="row">
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->body}}</td>
                        <td>{{$comment->user->name}}</td>
                        <td>{{class_basename($comment->comment_type)}}</td>
                        <td>{{$comment->comment_id}}</td>
                        <td>{{$comment->created_at}}</td>

                        <td>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="item-delete mlg-15"
                                        title="حذف" onclick="return confirm('آیا از حذف کامنت مطمئن هستید؟')"></button>
                            </form>
                            <a href="{{route('comments.show',$comment->id)}}" class="item-eye mlg-15" title="مشاهده"></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            {{$comments->links()}}
        </div>
    </div>

@endsection
