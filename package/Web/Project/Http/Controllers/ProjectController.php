<?php
namespace Web\Project\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Category\Repositories\CategoryRepository;
use Web\Media\Service\MediaFileService;
use Web\Notification\Services\NotificationService;
use Web\Project\Http\Requests\CreateProjectRequest;
use Web\Project\Http\Requests\UpdateProjectRequest;
use Web\Project\Models\Project;
use Web\Project\Repositories\ProjectRepository;
use Web\Project\Services\ProjectService;
use Web\User\Models\User;


class ProjectController extends Controller
{
    public $projectRepo;
    public $categorytRepo;
    protected $projectService;

    public function __construct(CategoryRepository $categoryRepo, ProjectService $projectService)
    {
        $this->categorytRepo = $categoryRepo;
        $this->projectService = $projectService;
    }


    public function index()
    {
        $this->authorize('index',Project::class);
        $projects=$this->projectService->getAllProjectForUser(auth()->user());
        return view('Project::index',compact('projects'));
    }

    public function show($id)
    {
        $project = $this->projectService->getProject($id);
        $this->authorize('show',$project);
        return view('Project::show',compact('project'));
    }

    public function create()
    {
        $this->authorize('create',Project::class);
        $categories = $this->categorytRepo->getAllCategory();
        return view('Project::create',compact('categories'));
    }

    public function store(CreateProjectRequest $request,NotificationService $notifier)
    {
        $this->authorize('store',Project::class);
        $validated = $request->validated();
        $media = MediaFileService::publicUpload($request->file('file'));
        $validated['file_id'] = $media->id;
        $this->projectService->storeProject($validated,$notifier,$media->id,auth()->user());
        return redirect()->route('projects.index');
    }

    public function edit($id)
    {
        $project = $this->projectService->getProject($id);;
        $this->authorize('edit',$project);
        $categories = $this->categorytRepo->getAllCategory();
        return view('Project::edit',compact('project','categories'));
    }

    public function update(UpdateProjectRequest $request,Project $project)
    {
        $this->authorize('update',$project);
        $validated = $request->validated();
        $this->projectService->updateProject($validated,$project);
        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete',$project);
        $this->projectService->deleteProject($project->id);
        return redirect()->route('projects.index');
    }

    public function members($projectId)
    {
        $project = $this->projectService->getProject($projectId);
        $this->authorize('members',$project);
        $members = $this->projectService->getProjectMembers($projectId);
        return view('Project::members.index',compact('project','members'));
    }


    public function createMemberToProject($projectId)
    {
        $project = $this->projectService->getProject($projectId);
        $this->authorize('members',$project);
        $users = User::all();
        return view('Project::members.create',compact('project','users'));
    }

    public function addMemberToProject(Request $request,Project $project)
    {
        $this->authorize('members',$project);
        $this->projectService->addUserToProject($project->id,$request->user_id);
        return redirect()->route('projects.index');
    }

    public function removeMemberToProject(Project $project,$userId)
    {
        $this->authorize('members',$project);
        $this->projectService->removeUserToProject($project->id,$userId);
        return redirect()->route('projects.index');
    }


    public function exportJson(Project $project, Request $request)
    {
        $data = $this->projectService->exportJson($project->id);
        if ($request->has('download')) {
            return response()->streamDownload(function () use ($data) {
                echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }, 'project-'.$project->id.'.json');
        }

        return response()->json($data, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    public function exportPdf(Project $project)
    {
        return $this->projectService->exportPdf($project->id);
    }

    public function searchProject(Request $request)
    {
        $projects = $this->projectService->search($request,auth()->user());
        return view('Project::index',compact('projects'));
    }


}
