@extends('Front::Board.master')

@section('content')
    <section class="lists-container">

        @foreach($uniqueTaskListNames as $taskListName)
            <div class="list">
                <h3 class="list-title">{{ $taskListName }}</h3>
                <ul class="list-items" data-task-list-id="{{ $board->taskLists->where('name', $taskListName)->first()->id }}">
                    @foreach($board->taskLists->where('name', $taskListName)->first()->tasks as $task)
                        <li class="task-item" data-task-id="{{ $task->id }}">
                            {{ $task->title }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach



        <form action="{{route('singleBoardAddTask',$board->id)}}" method="post" class="padding-30">
                @csrf
                <input type="text" name="title" class="text" placeholder="عنوان" >
                <br><br>
                    <x-select name="taskList">
                        <option  value="">انتخاب تسک لیست</option>
                        @foreach($board->taskLists as $taskList)
                            <option  value="{{ $taskList->id }}">{{ $taskList->name }}</option>
                        @endforeach
                    </x-select>

                <br><br>
                <button class="add-list-btn btn">Add a task</button>
            </form>
    </section>
@endsection
@section('content')
    <!-- محتوا -->
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    document.querySelectorAll('.list-items').forEach(list => {
        new Sortable(list, {
            group: 'shared',
            animation: 150,
            onEnd: function (evt) {
                const taskListElement = evt.to;
                const taskListId = taskListElement.dataset.taskListId;

                const tasks = Array.from(taskListElement.querySelectorAll('.task-item')).map((item, index) => {
                    return {
                        id: item.dataset.taskId,
                        order: index + 1
                    };
                });


                fetch("{{ route('updateTaskOrder') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        task_list_id: taskListId,
                        tasks: tasks
                    })
                }).then(response => response.json())
                    .then(data => {
                        console.log(data.status); // success
                    }).catch(error => {
                    alert('خطا در به‌روزرسانی ترتیب تسک‌ها');
                    console.error(error);
                });
            }
        });
    });
</script>

@endpush


