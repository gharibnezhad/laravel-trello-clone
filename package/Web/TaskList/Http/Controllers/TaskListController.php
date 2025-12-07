<?php
namespace Web\TaskList\Http\Controllers;

use App\Http\Controllers\Controller;
use Web\Board\Repositories\BoardRepository;
use Web\TaskList\Http\Requests\StoreTaskRequest;
use Web\TaskList\Http\Requests\UpdateTaskListRequest;
use Web\TaskList\Models\TaskList;
use Web\TaskList\Services\TaskListService;

class TaskListController extends Controller
{
    public $listService;
    public $boardRepo;


    public function __construct(
        TaskListService $listService, BoardRepository $boardRepo)
    {
        $this->listService = $listService;
        $this->boardRepo = $boardRepo;
    }

    public function index()
    {
        $this->authorize('index',TaskList::class);
        $taskLists = $this->listService->getTaskListWithBoard();
        return view('TaskList::Panel.index',compact('taskLists'));
    }

    public function create()
    {
        $this->authorize('index',TaskList::class);
        $boards = $this->boardRepo->findBoardsWithNameAndId();
        return view('TaskList::Panel.create',compact('boards'));
    }

    public function store (StoreTaskRequest $request)
    {
        $this->authorize('index',TaskList::class);
        $this->listService->storeTaskList($request->validated());
        return redirect()->route('taskLists.index');
    }

    public function edit(TaskList $taskList)
    {
        $taskList=$this->listService->findTaskListWithBoard($taskList->id);
        $this->authorize('index',$taskList);
        $boards = $this->boardRepo->getBoardsWithProject();
        return view('TaskList::Panel.edit',compact('taskList','boards'));
    }

    public function update(UpdateTaskListRequest $request,TaskList $taskList)
    {
        $this->authorize('index',$taskList);
        $this->listService->updateTaskList($taskList,$request->validated());
        return redirect()->route('taskLists.index');
    }

    public function destroy(TaskList $taskList)
    {
        $this->authorize('index',$taskList);
        $this->listService->delete($taskList->id);
        return redirect()->route('taskLists.index');
    }

}
