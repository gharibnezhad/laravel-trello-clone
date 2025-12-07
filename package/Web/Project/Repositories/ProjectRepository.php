<?php

namespace Web\Project\Repositories;

use Web\Project\Contracts\ProjectInterface;
use Web\Project\Models\Project;
use Web\User\Models\User;

class ProjectRepository implements ProjectInterface
{

    public function findProjectWithCategory($id)
    {
        $project = Project::with('category')->findOrFail($id);
        return $project;
    }

    public function getAllProjectForUser(User $user)
    {
        return Project::whereHas('users',function($query) use ($user){
            $query->where('users.id',$user->id);
        })->with(['category'])
            ->get();
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
        $project->delete();
        return $project;
    }

    public function findWithBoardsAndTasks($id)
    {
        $project = Project::with('boards.taskLists.tasks')
            ->findOrFail($id);

        return $project;
    }


}
