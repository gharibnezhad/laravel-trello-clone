<?php

namespace Web\Project\Services;

use Illuminate\Support\Facades\DB;
use Web\Category\Models\Category;
use Web\Export\Contracts\JsonExporterInterface;
use Web\Export\Contracts\PdfExporterInterface;
use Web\Export\Exporters\ProjectToJsonExporter;
use Web\Export\Services\ProjectExportService;
use Web\Export\Services\ProjectToPdfExportService;
use Web\Media\Models\Media;
use Web\Media\Service\DefaultFileService;
use Web\Media\Service\MediaFileService;
use Web\Member\Services\MemberService;
use Web\Project\Contracts\ProjectInterface;
use Web\Project\Models\Project;
use Web\Project\Notifications\ProjectCreatedNotification;
use Web\RolePermissions\Models\Role;
use Web\User\Models\User;

class ProjectService
{
    protected $projectRepo;
    protected $exportService;

    protected $pdfExportService;

    protected $memberService;

    public function __construct(ProjectInterface      $projectRepo,
                                JsonExporterInterface $exportService,
                                PdfExporterInterface  $pdfExportService,
                                MemberService         $memberService)
    {
        $this->projectRepo = $projectRepo;
        $this->exportService = $exportService;
        $this->pdfExportService = $pdfExportService;
        $this->memberService = $memberService;
    }


    public function storeProject(array $data, $notifier,int $mediaId)
    {
        DB::beginTransaction();

        try {
            $project = $this->projectRepo->store($data);
            $user = auth()->user();
            $user->projects()->attach($project->id, ['role_id' => Role::OWNER]);
            $notifier->send($user, new ProjectCreatedNotification($project));
            DB::commit();
            return $project;
        }catch (\Throwable $e){
            DB::rollBack();
            $media = Media::find($mediaId);
            if (!empty($data['file_id'])){
                  MediaFileService::delete($media);
                  $media->delete();
            }
            throw $e;
        }
    }

    public function updateProject(array $data, Project $project)
    {
        DB::beginTransaction();
        try {
            if (!empty($data['file'])){
                if ($project->media){
                    $project->media->delete();
                }
                $uploaded = MediaFileService::publicUpload($data['file']);
                $data['file_id'] = $uploaded->id;
            }else{
                $data['file_id'] = $project->file_id;
            }
            unset($data['file']);
           $project = $this->projectRepo->update($data, $project->id);
           DB::commit();
           return $project;

        }catch (\Throwable $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteProject($id)
    {
        $project = $this->projectRepo->findById($id);
        if ($project->media)
            $project->media->delete();
        $this->projectRepo->destroy($id);
        return $project;
    }

    public function exportJson($id)
    {
        $project = $this->projectRepo->findWithBoardsAndTasks($id);
        return $this->exportService->export($project);
    }

    public function exportPdf($id)
    {
        $project = $this->projectRepo->findById($id);
        return $this->pdfExportService->exportToPdf($project);
    }

    public function getProjectMembers($projectId)
    {
        return $this->memberService->getMember($projectId, 'project');
    }


    public function addUserToProject($projectId, $userId)
    {
        return $this->memberService->addMember('project', $projectId, $userId);
    }

    public function removeUserToProject($projectId, $userId)
    {
        return $this->memberService->removeMember('project', $projectId, $userId);
    }

    public function search($request,User $user)
    {
        $search = $request->search;
        $category = $request->category;
        $projectAll = Project::whereHas('users',function ($query) use ($user){
            $query->where('users.id',$user->id);
        })->with('category')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->whereHas('category', function ($query) use ($category) {
                $query->where('title', 'LIKE', '%' . $category . '%');
            });
        return $projectAll->get();

    }

    public function getAllProjectForUser(User $user)
    {
        return Project::whereHas('users',function($query) use ($user){
            $query->where('users.id',$user->id);
        })->get();
    }

    public function findProjectWithCategory($id)
    {
        $project = Project::with('category')->findOrFail($id);
        return $project;
    }

}
