<?php

namespace Web\Task\Services;


use Illuminate\Support\Facades\DB;
use Web\Board\Repositories\BoardRepository;
use Web\Member\Services\MemberService;
use Web\RolePermissions\Models\Role;
use Web\Task\Contracts\TaskInterface;
use Web\Task\Models\Task;
use Web\User\Models\User;

class TaskService
{

    protected $taskRepo;
    protected $memberService;
    protected $boardService;

    public function __construct(
        TaskInterface $taskRepo,
        MemberService $memberService,
        BoardRepository $boardService)
    {
        $this->taskRepo = $taskRepo;
        $this->memberService = $memberService;
        $this->boardService = $boardService;
    }

    private function mapTaskData(array $data)
    {
        return [
            'task_list_id' => $data['task_list_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'due_time' => $data['due_time'],
            'order' => $data['order'],
            'priority' => $data['priority'],
        ];
    }

    public function store($data,User $user)
    {
       return DB::transaction(function ()use ($data,$user){
            $taskData = $this->mapTaskData($data);
            $task = $this->taskRepo->store($taskData);
            $user->tasks()->attach($task->id,['role_id'=>Role::OWNER]);
            return $task;
        });

    }

    public function update(Task $task,$data)
    {
     return DB::transaction(function () use ($data,$task){
         $taskData = $this->mapTaskData($data);
         return $this->taskRepo->update($taskData,$task->id);
     });

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

    public function getTaskListsForBoard($boardId)
    {
        $board = $this->boardService->findBoardWithTaskLists($boardId);
        return $board->taskLists;
    }

    public function getTask($id): Task
    {
        $task = $this->taskRepo->findById($id);
        return $this->taskRepo->getTaskWithRelations($task);
    }

}
