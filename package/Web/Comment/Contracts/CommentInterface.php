<?php
namespace Web\Comment\Contracts;

use Illuminate\Database\Eloquent\Model;
use Web\User\Models\User;

interface CommentInterface
{

    public function findById( int $id);

    public function getAllComments();

    public function getAllCommentForType(Model $model);

    public function destroy(int $id);
}
