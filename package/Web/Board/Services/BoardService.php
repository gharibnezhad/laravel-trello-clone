<?php

namespace Web\Board\Services;

use Illuminate\Support\Facades\DB;
use Web\Board\Contracts\BoardInterface;
use Web\Board\Models\Board;
use Web\Member\Services\MemberService;
use Web\RolePermissions\Models\Role;
use Web\Task\Events\TaskCreated;
use Web\Task\Models\Task;
use Web\Task\Repositories\TaskRepository;
use Web\User\Models\User;

class BoardService
{

    protected $boardRepo;
    protected $TaskRepo;

    protected $memberService;

    public function __construct(BoardInterface $boardRepo, TaskRepository $TaskRepo,MemberService $memberService)
    {
        $this->boardRepo = $boardRepo;
        $this->TaskRepo = $TaskRepo;
        $this->memberService = $memberService;
    }

    public function storeBoard(array $data,User $user)
    {
        return DB::transaction(function () use ($data,$user){
            $board = $this->boardRepo->store($data);
            $user->boards()->attach($board->id,['role_id' => Role::OWNER]);
            $defaultTaskList =[
                ['name'=>'To Do','position'=>1000],
                ['name'=>'Doing','position'=>2000],
                ['name'=>'Done','position'=>3000],
            ];

                $board->taskLists()->createMany($defaultTaskList);

            return $board;
        });

    }

    public function updateBoard(array $data,Board $board)
    {
        return DB::transaction(function () use ($data,$board){
           return $this->boardRepo->update($data,$board->id);
        });
    }

    public function addTask($request,$id)
    {
        $this->boardRepo->findBoardWithProject($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'taskList' => 'required|exists:task_lists,id',
        ]);

        $taskListId = $validated['taskList'];

        $maxOrder = Task::where('task_list_id',$taskListId)->max('order');
        $nextOrder = $maxOrder ? $maxOrder + 1 : 1 ;

       $task = $this->TaskRepo->store([
            "title" => $validated['title'],
            "task_list_id" => $taskListId,
            "order" => $nextOrder
        ]);

        if (auth()->check()) {
            $task->users()->attach(auth()->id());
        }

        return $task;
    }

    public function updateTaskOrder($request)
    {
        $request->validate([
            'task_list_id' => 'required|integer|exists:task_lists,id',
            'tasks' => 'required|array',
            'tasks.*.id' => 'required|integer|exists:tasks,id',
            'tasks.*.order' => 'required|integer|min:1',
        ]);

        $taskListId = $request->input('task_list_id');
        $tasks = $request->input('tasks');

        foreach ($tasks as $taskData) {
            $task = Task::find($taskData['id']);
               $task->task_list_id = $taskListId;
               $task->order = $taskData['order'];

               $task->save();
        }

        return $tasks;
    }

    public function deleteBoard($id)
    {
        return $this->boardRepo->destroy($id);
    }


    public function getBoardMembers($boardId)
    {
        return $this->memberService->getMember($boardId,'board');
    }

    public function addUserToBoard($boardId, $userId)
    {
        return $this->memberService->addMember('board',$boardId,$userId);
    }

    public function removeUserToBoard($boardId, $userId)
    {
        return $this->memberService->removeMember('board',$boardId,$userId);
    }

    public function findBoardWithTaskLists($boardId)
    {
        return $this->boardRepo->findBoardWithTaskLists($boardId);
    }

}
