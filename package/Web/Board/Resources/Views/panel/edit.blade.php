@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ویرایش برد</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('boards.update',$board->id)}}" method="post" class="padding-30">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="name"  class="text" value="{{$board->name}}" placeholder="نام برد" required>

                    <select name="project_id" required>
                        <option value="">انتخاب پروژه</option>
                        @foreach($projects as $project)
                            <option value="{{$project->id}}"
                                {{old('project',$board->project_id) == $project->id ? 'selected' : '' }}
                            >{{$project->name}}</option>
                        @endforeach
                    </select>

                    <select name="visibility" required>
                        <option value="">وضعیت مشاهده</option>
                        @foreach(\Web\Board\Models\Board::getVisibilities() as $visibility)

                            <option value="{{$visibility}}"
                                {{old('visibility', $board->visibility) == $visibility ? 'selected' : ''}}
                            >@lang($visibility)</option>
                        @endforeach
                    </select>
                    <input type="number" name="order" class="text" value="{{$board->order}}" placeholder="ترتیب نمایش" required>

                    <button class="btn btn-webamooz_net">ویرایش برد</button>
                </form>
            </div>
        </div>
    </div>
@endsection
