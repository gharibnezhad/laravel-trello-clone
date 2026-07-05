<?php

namespace Web\Task\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Board\Repositories\BoardRepository;
use Web\Board\Services\BoardService;
use Web\Task\Http\Requests\CreateTaskRequest;
use Web\Task\Http\Requests\UpdateTaskRequest;
use Web\Task\Models\Task;
use Web\Task\Repositories\TaskRepository;
use Web\Task\Services\TaskService;
use Web\User\Models\User;

class TaskController extends Controller
{
    public $taskService;
    public $taskRepo;
    public $boardRepo;
    public $boardService;

    public function __construct(TaskRepository  $taskRepo,
                                BoardRepository $boardRepo,
                                TaskService     $taskService,
                                BoardService    $boardService)
    {
        $this->taskRepo = $taskRepo;
        $this->boardRepo = $boardRepo;
        $this->taskService = $taskService;
        $this->boardService = $boardService;
    }

    /** ---------------------------
     *  🔹 INDEX & CRUD SECTION
     * ---------------------------*/

    public function index()
    {
        $this->authorize('index',Task::class);
        $tasks = $this->taskService->getAllTaskForUser(auth()->user());
        return view('Tasks::Panel.index',compact('tasks'));
    }

    public function show($id)
    {
        $task = $this->taskService->getTask($id);
        return view('Tasks::Panel.show',compact('task'));
    }

    public function create()
    {
        $this->authorize('index',Task::class);
        $boards = $this->boardRepo->getAllBoardForUser(auth()->user());
        return view('Tasks::Panel.create',compact('boards'));
    }


    public function store(CreateTaskRequest $request)
    {
        $this->authorize('index',Task::class);
        $this->taskService->store($request->validated(),auth()->user());
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $task = $this->taskRepo->findById($task->id);
        $this->authorize('edit',$task);
        $boards = $this->boardRepo->getBoardsWithProject();
        return view('Tasks::Panel.edit',compact('task','boards'));
    }

    public function update(UpdateTaskRequest $request,Task $task)
    {
        $this->authorize('edit',$task);
        $this->taskService->update($task,$request->validated());
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $this->authorize('edit',$task);
        $this->taskService->delete($task->id);
        return redirect()->route('tasks.index');
    }

    /** ---------------------------
     *  🔹 MEMBER MANAGEMENT SECTION
     * ---------------------------*/

    public function members(Task $task)
    {
        $this->authorize('members',$task);
        $task = $this->taskRepo->findById($task->id);
        $members = $this->taskService->getTaskMembers($task->id);
        return view('Tasks::members.index',compact('task','members'));
    }

    public function createMemberToTask(Task $task)
    {
        $task = $this->taskRepo->findById($task->id);
        $this->authorize('members',$task);
        $users = User::all();
        return view('Tasks::members.create',compact('task','users'));
    }

    public function addMemberToTask(Request $request,Task $task)
    {
        $this->authorize('members',$task);
        $this->taskService->addUserToTask($task->id,$request->user_id);
        return redirect()->route('tasks.index');
    }

    public function removeMemberToTask(Task $task,$userId)
    {
        $this->authorize('members',$task);
        $this->taskService->removeMemberToTask($task->id,$userId);
        return redirect()->route('tasks.index');
    }

    /** ---------------------------
     *  🔹 UTILS
     * ---------------------------*/

    public function getTaskListsForBoard($boardId)
    {
        return response()->json($this->taskService->getTaskListsForBoard($boardId));
    }

}
