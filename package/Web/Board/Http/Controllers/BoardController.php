<?php

namespace Web\Board\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Board\Repositories\BoardRepositories;
use Web\Board\Services\BoardService;
use Web\Project\Repositories\ProjectRepository;

class BoardController extends Controller
{
    protected $boardRepo;
    protected $ProjectRepo;
    protected $boardService;

    public function __construct(BoardRepositories $boardRepo,
                                BoardService $boardService,
                                ProjectRepository $ProjectRepo)
    {
        $this->boardRepo = $boardRepo;
        $this->boardService = $boardService;
        $this->ProjectRepo = $ProjectRepo;
    }

    public function index()
    {
        $boards = $this->boardRepo->getAllBoards();
        return view('Board::panel.index',compact('boards'));
    }

    public function create()
    {
        $projects =$this->ProjectRepo->getAllProject();

        return view('Board::panel.create',compact('projects'));
    }

    public function store(Request $request)
    {
        $this->boardService->storeBoard($request);
        return redirect()->route('boards.index');
    }

    public function edit($id)
    {
        $board = $this->boardRepo->findById($id);
        return view('Board::panel.edit',compact('board'));
    }

    public function update(Request $request,$id)
    {
        $this->boardService->updateBoard($request,$id);

        return redirect()->route('boards.index');
    }

    public function destroy($id)
    {
        $this->boardService->deleteBoard($id);
        return redirect()->route('boards.index');
    }
}
