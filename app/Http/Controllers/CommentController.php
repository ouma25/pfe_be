<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function list(Request $request)
    {
        $request->validate([
            'professional' => ['required', 'numeric']
        ]);

        return DB::select("SELECT c.id, c.text, u.first_name, u.last_name FROM comments c JOIN users u ON u.id = c.user WHERE c.professional = :professional", ['professional' => $request->professional]);

        //return Comment::all()->where('professional', '=', $request->professional)->where('deleted', '=', 0);
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
