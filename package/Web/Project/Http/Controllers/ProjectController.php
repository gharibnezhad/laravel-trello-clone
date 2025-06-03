<?php
namespace Web\Project\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Category\Repositories\CategoryRepository;
use Web\Project\Repositories\ProjectRepository;


class ProjectController extends Controller
{
    public $projectRepo;
    public $categorytRepo;

    public function __construct(ProjectRepository $projectRepo,CategoryRepository $categoryRepo)
    {
        $this->projectRepo = $projectRepo;
        $this->categorytRepo = $categoryRepo;
    }


    public function index()
    {
        $projects=$this->projectRepo->getAllProject();
        return view('Project::index',compact('projects'));
    }

    public function create()
    {
        $categories = $this->categorytRepo->getAllCategory();
        return view('Project::create',compact('categories'));
    }

    public function store(Request $request)
    {
        $this->projectRepo->store($request);
        return redirect()->route('projects.index');
    }
}
