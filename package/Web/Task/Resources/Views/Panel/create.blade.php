@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="#" title="پروژه ها">پروژه ها</a></li>
@endsection
@section('content')
    <div class="main-content padding-0">
        <p class="box__title">ایجاد تسک جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('tasks.store')}}" method="post" class="padding-30">
                    @csrf

                    <select  id="board-select">
                        <option value="">انتخاب برد</option>
                        @foreach($boards as $board)
                            <option value="{{ $board->id }}">{{ $board->name }}</option>
                        @endforeach
                    </select>

                    <select name="task_list_id" id="taskList-select">
                        <option value=""> انتخاب تسک لیست</option>
                    </select>
                    <x-input type="text" name="title"  class="text" placeholder="عنوان تسک" />
                    <textarea name="description" placeholder="توضیحات تسک" class="text h" ></textarea>
                    <label for="due_time">زمان تحویل تسک</label>
                    <x-input type="datetime-local" name="due_time" class="text text-left " placeholder="موعد تحویل"/>
                    <x-input type="number" name="order"  class="text" placeholder="ترتیب نمایش" />
                    <x-select name="priority" >
                        <option value="">اولویت</option>
                        @foreach(\Web\Task\Models\Task::$priority as $priority)

                        <option value="{{$priority}}">{{$priority}}</option>
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
            $('#board-select').on('change', function () {
                const boardId = $(this).val();
                $('#taskList-select').html('<option value="">انتخاب تسک لیست</option>');
                $('#taskList-select').nextAll('.dropdown-select, .dd-search').remove();

                create_custom_dropdowns();

                if (!boardId) {
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
                                options += `<option value="${taskList.id}">${taskList.name}</option>`;
                            });
                        }

                        const select = $('#taskList-select');
                        select.html(options);
                        select.next('.dropdown-select').remove();

                        create_custom_dropdowns();
                    },
                    error: function (xhr) {
                        console.error("خطای AJAX:", xhr.responseText);
                        $('#taskList-select').html('<option value="">خطا در دریافت لیست</option>');

                    }
                });
            });
        });
    </script>
@endsection





