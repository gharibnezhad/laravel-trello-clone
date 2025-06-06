<?php

namespace Web\Project\Services;

use Web\Export\Contracts\JsonExporterInterface;
use Web\Export\Contracts\PdfExporterInterface;
use Web\Export\Exporters\ProjectToJsonExporter;
use Web\Export\Services\ProjectExportService;
use Web\Export\Services\ProjectToPdfExportService;
use Web\Project\Contracts\ProjectInterface;
use Web\Project\Notifications\ProjectCreatedNotification;

class ProjectService
{
    protected $projectRepo;
    protected $exportService;

    protected $pdfExportService;


    public function __construct(ProjectInterface $projectRepo,
                                JsonExporterInterface $exportService,
                                PdfExporterInterface $pdfExportService)
    {
        $this->projectRepo = $projectRepo;
        $this->exportService = $exportService;
        $this->pdfExportService = $pdfExportService;
    }




    public function storeProject($request,$notifier)
    {
        $user=auth()->user();
        $data =[
            "name" => $request->name,
            "slug" => $request->slug,
            "category_id" => $request->category_id,
            "description" => $request->description,
        ];
        $project = $this->projectRepo->store($data);
        $user->projects()->attach($project->id,['role'=>'viewer']);

        $notifier->send($user,new ProjectCreatedNotification($request));

        return $project;
    }

    public function updateProject($request,$id)
    {
        $project = $this->projectRepo->findById($id);

        $data =[
            "name" => $request->filled('name') ? $request->name : $project->name,
            "slug" => $request->filled('slug') ? $request->slug : $project->slug,
            "category_id" => $request->filled('category_id') ? $request->category_id : $project->category_id,
            "description" => $request->filled('description') ? $request->description : $project->description,
        ];

        return $this->projectRepo->update($data,$id);
    }

    public function deleteProject($id)
    {
        return $this->projectRepo->destroy($id);
    }

    public function exportJson($id)
    {
        $project = $this->projectRepo->findWithBoardsAndTasks($id);

        $exportService = $this->exportService;

        return $exportService->export($project);
    }

    public function exportPdf($id)
    {
        $project = $this->projectRepo->findById($id);

        $exportService = $this->pdfExportService;

        return $exportService->exportToPdf($project);
    }

}
