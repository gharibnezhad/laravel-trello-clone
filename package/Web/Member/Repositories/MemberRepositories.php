<?php

namespace Web\Member\Repositories;

use Web\Board\Models\Board;
use Web\Member\Contracts\MemberInterface;
use Web\Project\Models\Project;
use Web\RolePermissions\Models\Role;
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
        return $model->users()->attach($userId,['role_id'=>Role::MEMBER]);
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
            'board' => Board::findOrFail($id),
            default   => throw new \InvalidArgumentException("Invalid type: $type")
        };
    }
}
