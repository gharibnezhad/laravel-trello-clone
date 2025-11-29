<?php
namespace Web\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Web\Board\Models\Board;
use Web\Board\Repositories\BoardRepository;


class FrontController extends Controller
{
    protected $boardRepo;

    public function __construct(BoardRepository $boardRepo)
    {
        $this->boardRepo = $boardRepo;
    }

    public function index()
    {
        return view('Front::index');
    }


    public function singleBoard($id)
    {
        $board = $this->boardRepo->findById($id);
        $uniqueTaskListNames = $board->taskLists->pluck('name')->unique();
        return view('Front::Board.singleBoard',compact('board','uniqueTaskListNames'));
    }




}
