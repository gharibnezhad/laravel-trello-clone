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
                    <x-input type="text" name="name"  class="text" value="{{$board->name}}" placeholder="نام برد" />
                    <x-select name="project_id">
                        <option value="">انتخاب پروژه</option>
                        @foreach($projects as $project)
                            <option value="{{$project->id}}"
                                {{old('project',$board->project_id) == $project->id ? 'selected' : '' }}
                            >{{$project->name}}</option>
                        @endforeach
                    </x-select>
                    <x-select name="visibility">
                        <option value="">وضعیت مشاهده</option>
                        @foreach(\Web\Board\Models\Board::getVisibilities() as $visibility)

                            <option value="{{$visibility}}"
                                {{old('visibility', $board->visibility) == $visibility ? 'selected' : ''}}
                            >@lang($visibility)</option>
                        @endforeach
                    </x-select>
                    <x-input type="number" name="position" class="text" value="{{$board->position}}" placeholder="ترتیب نمایش"/>
                    <button class="btn btn-webamooz_net">ویرایش برد</button>
                </form>
            </div>
        </div>
    </div>
@endsection
