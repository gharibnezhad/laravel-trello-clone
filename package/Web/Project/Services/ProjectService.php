<?php

namespace Web\Project\Services;

use Web\Project\Interfaces\ProjectInterface;
use Web\Project\Notifications\ProjectCreatedNotification;

class ProjectService
{
    protected $projectRepo;


    public function __construct(ProjectInterface $projectRepo)
    {
        $this->projectRepo = $projectRepo;
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

}
