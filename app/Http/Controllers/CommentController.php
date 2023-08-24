<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Article $article) {
        $data = $request->validate([
            'content' => 'required|min:3',
        ]);
    
        $comment = new Comment();
        $comment->content = $data['content'];
        $comment->user_id = auth()->user()->id; // Assuming you have authentication set up
        $article->comments()->save($comment);
        return redirect()->back()->with('success', 'Comment posted successfully');
    }
    
}
