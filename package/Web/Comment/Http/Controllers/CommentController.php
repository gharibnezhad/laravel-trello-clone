<?php

namespace Web\Comment\Http\Controllers;
use App\Http\Controllers\Controller;
use Web\Comment\Models\Comment;
use Web\Comment\Services\CommentService;


class CommentController extends Controller
{

    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index()
    {
        $this->authorize('index',Comment::class);
        $comments = $this->commentService->getCommentList();
        return view('Comments::panel.index',compact('comments'));
    }

    public function show(Comment $comment)
    {
        $this->authorize('index',Comment::class);
        $comment = $this->commentService->getComment($comment->id);
        return view('Comments::panel.show',compact('comment'));
    }


    public function destroy(Comment $comment)
    {
        $this->authorize('index',Comment::class);
        return $this->commentService->delete($comment->id);
    }
}
