@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="اعضا پروژه">اعضا پروژه </a></li>
@endsection

@section('content')

    <div class="main-content">
        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>نام کاربر</th>
                    <th>ایمیل</th>
                    <th>حذف کاربر از پروژه</th>
                </tr>
                </thead>
                <tbody>

                @foreach($members as $member)
                    <tr role="row">
                        <td><a href="">{{$member->name}}</a></td>
                        <td><a href="">{{$member->email}}</a></td>
                        <td>
                            <form action="{{ route('removeUserToProject', [$project->id, $member->id]) }}" method="POST" onsubmit="return confirm('آیا مطمئنی؟')">
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
