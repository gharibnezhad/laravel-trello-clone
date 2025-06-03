<?php

namespace Web\Board\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Board\Repositories\BoardRepositories;
use Web\Project\Repositories\ProjectRepository;

class BoardController extends Controller
{
    private $boardRepo;
    private $ProjectRepo;

    public function __construct(BoardRepositories $boardRepo,ProjectRepository $ProjectRepo)
    {
        $this->boardRepo = $boardRepo;
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
        $this->boardRepo->store($request);
        return redirect()->route('boards.index');
    }
}
