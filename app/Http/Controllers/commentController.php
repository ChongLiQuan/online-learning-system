<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class commentController extends Controller
{
    public function addComment(Request $request)
    {
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        $comment_title = $request->input('comment_title');
        $comment_content = $request->input('comment_content');
        $discussion_id = $request->input('discussion_id');
        $comment_username = $request->input('comment_username');


        if ($comment_title == NULL || $discussion_id == NULL) {
            return redirect('addComment')->with('error_status', 'Please enter a comment title!');
        } else {
            DB::select('insert into comment_list (comment_title, comment_content, discussion_id, comment_username, created_at) 
            values (?,?,?,?,?)', [$comment_title, $comment_content, $discussion_id, $comment_username, $current_date_time]);

            return redirect('addComment')->with('pass_status', 'Comment Added Successfully.');
        }
    }
}
