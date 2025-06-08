<?php
namespace Web\TaskList\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Board\Models\Board;
use Web\Board\Repositories\BoardRepositories;
use Web\Board\Services\BoardService;
use Web\TaskList\Services\TaskListService;

class TaskListController extends Controller
{
    public $listService;
    public $boardRepo;

    public function __construct(TaskListService $listService,BoardRepositories $boardRepo)
    {
        $this->listService = $listService;
        $this->boardRepo = $boardRepo;
    }

    public function index()
    {
        $taskLists = $this->listService->all();
        return view('TaskList::Panel.index',compact('taskLists'));
    }

    public function create()
    {
        $boards = $this->boardRepo->findBoardsWithNameAndId();
        return view('TaskList::Panel.create',compact('boards'));
    }

    public function store (Request $request)
    {
        $this->listService->storeTaskList($request);

        return redirect()->route('taskLists.index');
    }

    public function edit($id)
    {
        $taskList=$this->listService->findTaskList($id);
        $boards = $this->boardRepo->getAllBoards();
        $selectedBoardId = $taskList->board_id;
        return view('TaskList::Panel.edit',compact('taskList','boards','selectedBoardId'));
    }

    public function update(Request $request,$id)
    {
        $this->listService->updateTaskList($request,$id);

        return redirect()->route('taskLists.index');
    }
}
