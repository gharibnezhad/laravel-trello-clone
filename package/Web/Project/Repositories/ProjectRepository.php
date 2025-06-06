<?php

namespace Web\Project\Repositories;

use Web\Project\Contracts\ProjectInterface;
use Web\Project\Models\Project;
use Web\Project\Notifications\ProjectCreatedNotification;

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

    public function store($data)
    {
        return  Project::create($data);
    }

    public function update($data,$id)
    {
        $project=Project::findOrFail($id);
        return $project->update($data);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        return $project->delete($id);
    }

    public function findWithBoardsAndTasks($id)
    {
        $project = Project::with('boards.taskLists.tasks')
            ->findOrFail($id);

        return $project;
    }
}
