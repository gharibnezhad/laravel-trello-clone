@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="اعضا برد">اعضا برد </a></li>
@endsection

@section('content')

    <div class="main-content">
        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>نام کاربر</th>
                    <th>ایمیل</th>
                    <th>حذف کاربر از برد</th>
                </tr>
                </thead>
                <tbody>

                @foreach($members as $member)
                    <tr role="row">
                        <td><a href="">{{$member->name}}</a></td>
                        <td><a href="">{{$member->email}}</a></td>
                        <td>
                            <form action="{{ route('removeUserToTask', [$task->id, $member->id]) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
