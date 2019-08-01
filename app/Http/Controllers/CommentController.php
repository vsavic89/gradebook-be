<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\CommentsGradebook;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function show($gradebookID)
    {
        $comments = DB::table('comments')
        ->select(
            'comments.id', 
            'comments.content', 
            'comments.user_id',
            'comments.created_at',
            'users.first_name',
            'users.last_name'
        )
        ->join(
            'users',
            'users.id','=','comments.user_id'
        )
        ->join(
            'comments_gradebooks',
            'comments_gradebooks.comment_id','=','comments.id'                        
            )
        ->where('comments_gradebooks.gradebook_id','=',$gradebookID)->get();

        return $comments;
    }

    public function store(Request $request)
    {        
        $comment = new Comment();
        $comment->content = $request['content'];
        $comment->user_id = $request['user_id'];
        $comment->save();

        $commentsGradebook = new CommentsGradebook();
        $commentsGradebook->comment_id = $comment->id;
        $commentsGradebook->gradebook_id = $request['gradebook_id'];
        $commentsGradebook->save();

        return $comment;
    }
    
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        DB::table('comments_gradebooks')->where('comment_id', '=', $id)->delete();            
    }
}
