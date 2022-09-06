<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $sub_comment = $request->input('sub_comment');

        if  ($discussion_id == NULL) {
            return redirect('addComment')->with('error_status', 'Please relog and try again!');
        } else {
            DB::select('insert into comment_list (comment_title, comment_content, discussion_id, comment_username, created_at, sub_comment) 
            values (?,?,?,?,?,?)', [$comment_title, $comment_content, $discussion_id, $comment_username, $current_date_time, $sub_comment]);

            return redirect('addComment')->with('pass_status', 'Comment Added Successfully.');
        }
    }

    public function deleteComment(Request $request)
    {
        $id = $request->input('delete_id');

        DB::table('comment_list')->where('comment_id', [$id])->delete();
        return back()->with('delete_pass_status', 'Comment Deleted Successfully! ');
    }

    public function editComment(Request $request)
    {
        $comment_id = $request->input('comment_id');

        $comment_title = $request->input('comment_title');
        $comment_content = $request->input('comment_content');
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        $data = array(
            "comment_title" => $comment_title,
            "comment_content" => $comment_content,
            "updated_at" => $current_date_time,
        );

        if ($comment_title == NULL || $comment_content == NULL) {
            return redirect('editComment')->with('error_status', 'Please enter a comment title or a content!');
        } else {
            DB::table('comment_list')->where('comment_id', $comment_id)->update($data);

            return back()->with('pass_status', 'Comment Edited Successfully.');
        }
    }
}
