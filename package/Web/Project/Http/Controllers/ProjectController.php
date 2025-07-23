<?php
namespace Web\Project\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Category\Repositories\CategoryRepository;
use Web\Notification\Services\NotificationService;
use Web\Project\Http\Requests\CreateProjectRequest;
use Web\Project\Repositories\ProjectRepository;
use Web\Project\Services\ProjectService;
use Web\User\Models\User;


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
        // todo display a project you must singleProject.blade
        $project = $this->projectRepo->findById($id);
        return view('Project::show',compact('project'));
    }

    public function create()
    {
        $categories = $this->categorytRepo->getAllCategory();
        return view('Project::create',compact('categories'));
    }

    public function store(CreateProjectRequest $request,NotificationService $notifier)
    {
        // todo creating a modular FileUploader
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

    public function members($projectId)
    {
        $members = $this->projectService->getProjectMembers($projectId);
        $project = $this->projectRepo->findById($projectId);
        return view('Project::members.index',compact('members','project'));
    }


    public function createMemberToProject($projectId)
    {
        $project = $this->projectRepo->findById($projectId);
        $users = User::all();

        return view('Project::members.create',compact('project','users'));
    }

    public function addMemberToProject(Request $request,$projectId)
    {
        $this->projectService->addUserToProject($projectId,$request->user_id);
        return redirect()->route('projects.index');
    }

    public function removeMemberToProject($projectId,$userId)
    {
        $this->projectService->removeUserToProject($projectId,$userId);
        return redirect()->route('projects.index');
    }

    public function exportJson($id)
    {
       return $this->projectService->exportJson($id);
    }

    public function exportPdf($id)
    {
        // todo refactor this method for export pdf
        return $this->projectService->exportPdf($id);
    }

}
