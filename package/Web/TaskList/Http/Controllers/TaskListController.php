<?php
namespace Web\TaskList\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Board\Repositories\BoardRepository;
use Web\TaskList\Models\TaskList;
use Web\TaskList\Services\TaskListService;

class TaskListController extends Controller
{
    public $listService;
    public $boardRepo;

    public function __construct(TaskListService $listService, BoardRepository $boardRepo)
    {
        $this->listService = $listService;
        $this->boardRepo = $boardRepo;
    }

    public function index()
    {
        $this->authorize('index',TaskList::class);
        $taskLists = $this->listService->getAllTaskLists();
        return view('TaskList::Panel.index',compact('taskLists'));
    }

    public function create()
    {
        $this->authorize('create',TaskList::class);
        $boards = $this->boardRepo->findBoardsWithNameAndId();
        return view('TaskList::Panel.create',compact('boards'));
    }

    public function store (Request $request)
    {
        $this->authorize('store',TaskList::class);
        $this->listService->storeTaskList($request);
        return redirect()->route('taskLists.index');
    }

    public function edit($id)
    {
        $taskList=$this->listService->findTaskList($id);
        $this->authorize('edit',$taskList);
        $boards = $this->boardRepo->getBoardsWithProject();
        return view('TaskList::Panel.edit',compact('taskList','boards'));
    }

    public function update(Request $request,TaskList $taskList)
    {
        $this->authorize('update',$taskList);
        $this->listService->updateTaskList($request,$taskList->id);
        return redirect()->route('taskLists.index');
    }

    public function destroy(TaskList $taskList)
    {
        $this->authorize('delete',$taskList);
        $this->listService->delete($taskList->id);
        return redirect()->route('taskLists.index');
    }

}
