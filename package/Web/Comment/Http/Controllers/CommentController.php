<?php

namespace Web\Comment\Http\Controllers;
use App\Http\Controllers\Controller;
use Web\Comment\Models\Comment;
use Web\Comment\Repositories\CommentRepository;
use Web\Comment\Services\CommentService;


class CommentController extends Controller
{
    protected $commentRepo;
    protected $commentService;

    public function __construct(CommentRepository $commentRepo,CommentService $commentService)
    {
        $this->commentRepo = $commentRepo;
        $this->commentService = $commentService;
    }

    public function index()
    {
        $this->authorize('index',Comment::class);
        $comments = $this->commentRepo->getAllComments();
        return view('Comments::panel.index',compact('comments'));
    }

    public function show(Comment $comment)
    {
        $this->authorize('index',Comment::class);
        $comment = $this->commentRepo->findById($comment->id);
        return view('Comments::panel.show',compact('comment'));
    }


    public function destroy(Comment $comment)
    {
        $this->authorize('index',Comment::class);
        return $this->commentService->delete($comment->id);
    }
}
