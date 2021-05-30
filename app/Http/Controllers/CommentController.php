<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function list()
    {
        return Comment::all()->where('deleted', '=', 0);
    }

    public function add(Requet $requet)
    {
        $requet->validate([
            'user' => ['required', 'numeric'],
            'text' => ['required', 'text'],
            'professional' => ['required', 'numeric']
        ]);

        return Comment::create([
            'user' => $requet->user,
            'text' => $requet->text,
            'professional' => $requet->professional
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric']
        ]);

        $comment = Comment::find($request->id);
        $comment->deleted = 1;
        return $comment->save();
    }
}
