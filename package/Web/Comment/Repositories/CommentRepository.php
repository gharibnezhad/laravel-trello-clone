<?php

namespace Web\Comment\Repositories;

use Illuminate\Database\Eloquent\Model;
use Web\Comment\Contracts\CommentInterface;
use Web\Comment\Models\Comment;

class CommentRepository implements CommentInterface
{

    public function findById(int $id)
    {
        return Comment::with('user','child.user')->findOrFail($id);
    }

    public function paginateWithUser(int $perPage=10)
    {
       return Comment::with('user')
       ->orderByDesc('id')->paginate($perPage);
    }

    public function getAllCommentForType(Model $model)
    {
        // TODO: Implement getAllCommentForType() method.
    }

    public function destroy(int $id)
    {
        return $this->findById($id)->delete();
    }
}
