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

        return DB::select("SELECT c.id as comment_id, c.text, u.image, c.user as commenter, u.id as user_id, concat(u.first_name, ' ', u.last_name) as full_name, c.created_at FROM comments c JOIN users u ON u.id = c.user WHERE c.professional = :professional", ['professional' => $request->professional]);

        //return Comment::all()->where('professional', '=', $request->professional)->where('deleted', '=', 0);
    }

    public function add(Request $requet)
    {
        $requet->validate([
            'user' => ['required', 'numeric'],
            'text' => ['required', 'string'],
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

        return Comment::where('id', '=', $request->id)->delete();
    }
}
