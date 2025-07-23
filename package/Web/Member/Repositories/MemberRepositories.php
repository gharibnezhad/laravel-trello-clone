<?php

namespace Web\Member\Repositories;

use Web\Member\Contracts\MemberInterface;
use Web\Project\Models\Project;
use Web\Task\Models\Task;

class MemberRepositories implements MemberInterface
{

    public function getMember($data)
    {
        $model = $this->resolveModel($data['type'],$data['id']);
        return $model->users;
    }

    public function addMember($type, $id, $userId)
    {
        $model = $this->resolveModel($type,$id);
        return $model->users()->attach($userId);
    }

    public function removeMember($type, $id, $userId)
    {
        $model = $this->resolveModel($type,$id);
        return $model->users()->detach($userId);
    }

    public function resolveModel($type,$id)
    {
        return match ($type){
            'project' => Project::findOrFail($id),
            'task' => Task::findOrFail($id),
            default   => throw new \InvalidArgumentException("Invalid type: $type")
        };
    }
}
