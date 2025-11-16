@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ویرایش تسک لیست</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('taskLists.update',$taskList->id)}}" method="post" class="padding-30">
                    @csrf
                    @method('PATCH')
                    <x-input type="text" name="name" class="text" value="{{old('name',$taskList->name)}}"
                             placeholder="عنوان"/>
                    <x-input type="number" name="position" class="text text-left" value="{{old('position',$taskList->position)}}"
                             placeholder="ترتیب نمایش"/>
                    <x-select name="board_id">
                        <option value="">انتخاب برد</option>
                        @foreach($boards as  $board)
                            <option value="{{ $board->id }}" {{ $board->id == old('board_id', $taskList->board_id ?? '') ? 'selected' : '' }}>
                            {{ $board->name }}
                        @endforeach
                    </x-select>
                    <button class="btn btn-webamooz_net">ایجاد پروژه</button>
                </form>
            </div>
        </div>
    </div>
@endsection
