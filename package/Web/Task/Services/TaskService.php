<?php

namespace Web\Task\Services;


use Web\Member\Services\MemberService;
use Web\RolePermissions\Models\Role;
use Web\Task\Contracts\TaskInterface;
use Web\Task\Models\Task;
use Web\User\Models\User;

class TaskService
{

    protected $taskRepo;
    protected $memberService;

    public function __construct(TaskInterface $taskRepo,MemberService $memberService)
    {
        $this->taskRepo = $taskRepo;
        $this->memberService = $memberService;
    }

    public function store($request)
    {
        $user = auth()->user();
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'task_list_id' => $request->task_list_id,
            'due_time' => $request->due_time,
            'priority' => $request->priority,
            'order' => $request->order,
        ];
       $tasks = $this->taskRepo->store($data);
       $user->tasks()->attach($tasks->id,['role_id'=>Role::OWNER]);

       return $tasks;
    }

    public function update($request,$taskId)
    {
        $task = $this->taskRepo->findById($taskId);
        $data =  [
            'title' => $request->filled('title') ? $request->title : $task->title,
            'description' => $request->filled('description') ? $request->description : $task->description,
            'task_list_id' => $request->filled('task_list_id') ? $request->task_list_id : $task->task_list_id,
            'due_time' => $request->filled('due_time') ? $request->due_time : $task->due_time,
            'priority' => $request->filled('priority') ? $request->priority : $task->priority,
            'order' => $request->filled('order') ? $request->order : $task->order,
        ];
       return $this->taskRepo->update($data,$taskId);
    }

    public function getTaskMembers($taskId)
    {
        return $this->memberService->getMember($taskId,'task');
    }

    public function addUserToTask($taskId,$userId)
    {
        return $this->memberService->addMember('task',$taskId,$userId);
    }

    public function removeMemberToTask($taskId, $userId)
    {
        return $this->memberService->removeMember('task',$taskId,$userId);
    }

    public function delete($id)
    {
        return $this->taskRepo->destroy($id);
    }

    public function getAllTaskForUser(User $user)
    {
       return Task::whereHas('taskList.board.users',function ($query) use ($user){
            $query->where('user_id',$user->id);
        })->with(['taskList.board'])->get();
    }


}
