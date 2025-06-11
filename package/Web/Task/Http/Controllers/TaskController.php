<?php

namespace Web\Task\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Web\Board\Repositories\BoardRepositories;
use Web\Task\Repositories\TaskRepository;
use Web\Task\Services\TaskService;
use Web\TaskList\Repositories\TaskListRepository;
use Web\User\Models\User;

class TaskController extends Controller
{
    public $taskService;
    public $taskRepo;
    public $boardRepo;

    public function __construct(TaskRepository $taskRepo,
                                BoardRepositories $boardRepo,
                                TaskService $taskService)
    {
        $this->taskRepo = $taskRepo;
        $this->boardRepo = $boardRepo;
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskRepo->getAllTask();
        return view('Tasks::Panel.index',compact('tasks'));
    }

    public function create()
    {
        $boards = $this->boardRepo->getAllBoards();
        $users = User::all();
        return view('Tasks::Panel.create',compact('boards','users'));
    }

    public function getByBoard($boardId)
    {
        $board = $this->boardRepo->findById($boardId);
        return response()->json($board->taskLists()->select('id', 'name')->get());
    }

    public function store(Request $request)
    {
        // todo created_at and updated_at users
        $this->taskService->store($request);
        return redirect()->route('tasks.index');
    }
}
