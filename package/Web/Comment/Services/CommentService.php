<?php

namespace Web\Comment\Services;

use Web\Comment\Contracts\CommentInterface;

class CommentService
{

    protected $commentRepo;


    public function __construct(CommentInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function getComment($id)
    {
        return $this->commentRepo->findById($id);
    }

    public function getCommentList()
    {
        return $this->commentRepo->paginateWithUser();
    }

    public function delete($id)
    {
        return $this->commentRepo->destroy($id);
    }


}
