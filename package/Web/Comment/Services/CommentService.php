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

    public function delete($id)
    {
        return $this->commentRepo->destroy($id);
    }


}
