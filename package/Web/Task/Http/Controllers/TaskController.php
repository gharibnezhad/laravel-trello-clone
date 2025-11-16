<?php

namespace Web\Task\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Board\Repositories\BoardRepositories;
use Web\Board\Services\BoardService;
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

    public function __construct(TaskRepository $taskRepo,
                                BoardRepositories $boardRepo,
                                TaskService $taskService,
                                BoardService $boardService)
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

    public function create()
    {
        $this->authorize('create',Task::class);
        $boards = $this->boardService->getAllBoardForUser(auth()->user());
        return view('Tasks::Panel.create',compact('boards'));
    }



    public function store(Request $request)
    {
        $this->authorize('create',Task::class);
        $this->taskService->store($request);
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $task = $this->taskRepo->findById($task->id);
        $this->authorize('update',$task);
        $boards = $this->boardRepo->getAllBoards();
        return view('Tasks::Panel.edit',compact('task','boards'));
    }

    public function update(Request $request,Task $task)
    {
        $this->authorize('update',$task);
        $this->taskService->update($request,$task->id);
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete',$task);
        $this->taskService->delete($task->id);
        return redirect()->route('tasks.index');
    }

    /** ---------------------------
     *  🔹 MEMBER MANAGEMENT SECTION
     * ---------------------------*/

    public function members($taskId)
    {
        $this->authorize('index',Task::class);
        $task = $this->taskRepo->findById($taskId);
        $members = $this->taskService->getTaskMembers($taskId);
        return view('Tasks::members.index',compact('task','members'));
    }

    public function createMemberToTask($taskId)
    {
        $task = $this->taskRepo->findById($taskId);
        $this->authorize('update',$task);
        $users = User::all();
        return view('Tasks::members.create',compact('task','users'));
    }

    public function addMemberToTask(Request $request,Task $task)
    {
        $this->authorize('update',$task);
        $this->taskService->addUserToTask($task->id,$request->user_id);
        return redirect()->route('tasks.index');
    }

    public function removeMemberToTask(Task $task,$userId)
    {
        $this->authorize('update',$task);
        $this->taskService->removeMemberToTask($task->id,$userId);
        return redirect()->route('tasks.index');
    }

    /** ---------------------------
     *  🔹 UTILS
     * ---------------------------*/

    public function getByBoard($boardId)
    {
        $board = $this->boardRepo->findById($boardId);
        return response()->json($board->taskLists()->select('id', 'name')->get());
    }

}
