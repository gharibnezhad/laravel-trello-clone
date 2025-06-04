@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ایجاد برد جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('boards.store')}}" method="post" class="padding-30">
                    @csrf
                    <input type="text" name="name"  class="text" placeholder="نام برد" required>
                    <select name="project_id" required>
                        <option value="">انتخاب پروژه</option>
                        @foreach($projects as $project)

                            <option value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    </select>

                    <select name="visibility" required>
                        <option value="">وضعیت مشاهده</option>
                        @foreach(\Web\Board\Models\Board::getVisibilities() as $visibility)

                            <option value="{{$visibility}}">@lang($visibility)</option>
                        @endforeach
                    </select>
                    <input type="number" name="order"  class="text" placeholder="ترتیب نمایش" required>

                    <button class="btn btn-webamooz_net">ایجاد برد</button>
                </form>
            </div>
        </div>
    </div>
@endsection
