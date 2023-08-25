<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(Article $article)
    {
        // Assuming you're using Laravel's built-in authentication
        $user = auth()->user();

        // Check if the user has already liked the article
        if (!$article->likes()->where('user_id', $user->id)->exists()) {
            $like = new Like();
            $like->user_id = $user->id;
            $article->likes()->save($like);
        }

        return back(); // Redirect back to the article or wherever you want
    }

    public function destroy(Article $article)
    {
        $user = auth()->user();

        // Find and delete the like if it exists
        $article->likes()->where('user_id', $user->id)->delete();

        return back(); // Redirect back to the article or wherever you want
    }
}
