<?php

namespace Web\Board\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Board\Http\Requests\BoardRequest;
use Web\Board\Models\Board;
use Web\Board\Repositories\BoardRepository;
use Web\Board\Services\BoardService;
use Web\Project\Services\ProjectService;
use Web\User\Models\User;

class BoardController extends Controller
{
    protected $boardRepo;
    protected $projectService;
    protected $boardService;

    public function __construct(BoardRepository $boardRepo,
                                BoardService    $boardService,
                                ProjectService  $projectService)
    {
        $this->boardRepo = $boardRepo;
        $this->boardService = $boardService;
        $this->projectService = $projectService;
    }

    public function index()
    {
        $this->authorize('index',Board::class);
        $boards = $this->boardRepo->getAllBoardForUser(auth()->user());
        return view('Board::panel.index',compact('boards'));
    }

    public function create()
    {
        $this->authorize('create',Board::class);
        $projects =$this->projectService->getAllProjectForUser(auth()->user());
        return view('Board::panel.create',compact('projects'));
    }

    public function show($id)
    {
        $board = $this->boardRepo->findBoardWithProject($id);
        $this->authorize('view',$board);
        return view('Board::panel.show',compact('board'));
    }

    public function store(BoardRequest $request)
    {
        $this->authorize('store',Board::class);
        $this->boardService->storeBoard($request->validated(),auth()->user());
        return redirect()->route('boards.index');
    }

    public function edit($id)
    {
        $board = $this->boardRepo->findBoardWithProject($id);
        $this->authorize('edit',$board);
        $projects =$this->projectService->getAllProjectForUser(auth()->user());
        return view('Board::panel.edit',compact('board','projects'));
    }

    public function update(BoardRequest $request,Board $board)
    {
        $this->authorize('update',$board);
        $this->boardService->updateBoard($request->validated(),$board);
        return redirect()->route('boards.index');
    }

    public function destroy(Board $board)
    {
        $this->authorize('delete',$board);
        $this->boardService->deleteBoard($board->id);
        return redirect()->route('boards.index');
    }

    public function singleBoardAddTask(Request $request,$id)
    {
        $this->boardService->addTask($request,$id);
        return redirect()->back();
    }

    public function updateTaskOrder(Request $request)
    {
        $this->boardService->updateTaskOrder($request);

        return response()->json(['status' => 'success']);

    }

    public function members($boardId)
    {
        $board = $this->boardRepo->findBoardWithProject($boardId);
        $this->authorize('members',$board);
        $members = $this->boardService->getBoardMembers($boardId);
        return view('Board::members.index',compact('members','board'));
    }

    public function createMemberToBoard($boardId)
    {
        $board = $this->boardRepo->findBoardWithProject($boardId);
        $this->authorize('createMemberToBoard',$board);
        $users = User::all();
        return view('Board::members.create',compact('board','users'));
    }

    public function addMemberToBoard(Request $request,Board $board)
    {
        $this->authorize('addMemberToBoard',$board);
        $this->boardService->addUserToBoard($board->id,$request->user_id);
        return redirect()->route('boards.index');
    }

    public function removeMemberToBoard(Board $board,$userId)
    {
        $this->authorize('removeMemberToBoard',$board);
        $this->boardService->removeUserToBoard($board->id,$userId);
        return redirect()->route('boards.index');
    }
}
