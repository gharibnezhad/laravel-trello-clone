@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ویرایش پروژه</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('tasks.update',$task->id)}}" method="post" class="padding-30">
                    @csrf
                    @method('PATCH')
                    <x-select name="board_id" id="board-select">
                        <option value="">انتخاب برد</option>
                        @foreach($boards as $board)
                            <option value="{{ $board->id}}"{{old('board_id',$task->taskList->board->id)
                         == $board->id ? 'selected' : ''}}>{{ $board->name }}</option>
                        @endforeach
                    </x-select>

                    <x-select name="task_list_id" id="taskList-select">
                        <option value=""> انتخاب تسک لیست</option>
                    </x-select>
                    <x-input type="text" name="title" class="text" placeholder="عنوان تسک"
                             value="{{$task->title}}" />
                    <x-textarea name="description" placeholder="توضیحات تسک" class="text h"
                                value="{{$task->description}}"></x-textarea>
                    <label for="due_time">زمان تحویل تسک</label>
                    @php
                        $dueValue = old('due_time') ?:
                        ($task->due_time ? \Carbon\Carbon::parse($task->due_time)
                        ->format('Y-m-d\TH:i') : null);
                    @endphp
                    <x-input type="datetime-local" name="due_time" class="text text-left "
                             value="{{$dueValue}}" placeholder="موعد تحویل"/>
                    <x-input type="number" name="order" class="text" value="{{$task->order}}" placeholder="ترتیب نمایش"/>
                    <x-select name="priority">
                        <option value="">اولویت</option>
                        @foreach(\Web\Task\Models\Task::$priority as $priority)

                            <option value="{{$priority}}"
                                {{ old('priority', $task->priority) == $priority ? 'selected' : '' }}
                            >{{$priority}}</option>
                        @endforeach
                    </x-select>

                    <button class="btn btn-webamooz_net">ایجاد تسک</button>
                </form>
            </div>
        </div>
    </div>
@endsection
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
@section('js')
    <script>
        $(document).ready(function () {
            function loadTaskLists(boardId, selectedTaskListId = null) {
                if (!boardId) {
                    $('#taskList-select').html('<option value="">انتخاب تسک لیست</option>');
                    return;
                }

                $.ajax({
                    url: "{{ url('/taskLists/by-board') }}/" + boardId,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        let options = '';
                        if (data.length === 0) {
                            options = '<option value="">لیستی یافت نشد</option>';
                        } else {
                            data.forEach(function (taskList) {
                                const selected = (selectedTaskListId && selectedTaskListId == taskList.id) ? 'selected' : '';
                                options += `<option value="${taskList.id}" ${selected}>${taskList.name}</option>`;
                            });
                        }

                        const select = $('#taskList-select');
                        select.html(options);
                        select.next('.dropdown-select').remove();
                        create_custom_dropdowns();
                    },
                    error: function (xhr) {
                        console.error("❌ خطای AJAX:", xhr.responseText);
                        $('#taskList-select').html('<option value="">خطا در دریافت لیست</option>');
                    }
                });
            }


            $('#board-select').on('change', function () {
                const boardId = $(this).val();
                $('#taskList-select').html('<option value="">انتخاب تسک لیست</option>');
                $('#taskList-select').nextAll('.dropdown-select, .dd-search').remove();
                create_custom_dropdowns();

                if (!boardId) return;

                loadTaskLists(boardId);
            });


            const initialBoardId = "{{ old('board_id', $task->taskList->board->id ?? '') }}";
            const initialTaskListId = "{{ old('task_list_id', $task->task_list_id ?? '') }}";

            if (initialBoardId) {

                loadTaskLists(initialBoardId, initialTaskListId);
            }
        });
    </script>
@endsection
