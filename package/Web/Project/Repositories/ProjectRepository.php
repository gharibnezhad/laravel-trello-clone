<?php

namespace Web\Project\Repositories;

use Web\Project\Models\Project;

class ProjectRepository implements ProjectInterface
{

    public function findById($id)
    {
        return Project::findOrFail($id);
    }

    public function getAllProject()
    {
        return Project::all();
    }

    public function store($request)
    {
        $user=auth()->user();
        $project= Project::create([
            "name" => $request->name,
            "slug" => $request->slug,
            "category_id" => $request->category_id,
            "description" => $request->description,
        ]);

        $user->projects()->attach($project->id,['role'=>'viewer']);

        return $project;
    }
}
