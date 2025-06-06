<?php
namespace Web\Project\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Category\Repositories\CategoryRepository;
use Web\Notification\Services\NotificationService;
use Web\Project\Repositories\ProjectRepository;
use Web\Project\Services\ProjectService;


class ProjectController extends Controller
{
    public $projectRepo;
    public $categorytRepo;
    protected $projectService;

    public function __construct(ProjectRepository $projectRepo,
                                CategoryRepository $categoryRepo,
                                ProjectService $projectService)
    {
        $this->projectRepo = $projectRepo;
        $this->categorytRepo = $categoryRepo;
        $this->projectService = $projectService;
    }


    public function index()
    {
        $projects=$this->projectRepo->getAllProject();
        return view('Project::index',compact('projects'));
    }

    public function show($id)
    {
        // todo display a product you must singleProduct.blade
        $project = $this->projectRepo->findById($id);
        return view('Project::show',compact('project'));
    }

    public function create()
    {
        $categories = $this->categorytRepo->getAllCategory();
        return view('Project::create',compact('categories'));
    }

    public function store(Request $request,NotificationService $notifier)
    {
        $this->projectService->storeProject($request,$notifier);

        return redirect()->route('projects.index');
    }

    public function edit($id)
    {
        $project = $this->projectRepo->findById($id);
        $categories = $this->categorytRepo->getAllCategory();
        return view('Project::edit',compact('project','categories'));
    }

    public function update(Request $request,$id)
    {
        $this->projectService->updateProject($request,$id);

        return redirect()->route('projects.index');
    }

    public function destroy($id)
    {
        $this->projectService->deleteProject($id);

        return redirect()->route('projects.index');
    }

    public function addMember()
    {

    }

    public function exportJson($id)
    {
       return $this->projectService->exportJson($id);
    }

    public function exportPdf($id)
    {
        return $this->projectService->exportPdf($id);
    }
}
