<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{


    public function store(Request $request)
    {
        $replies = new Reply;
        $form = $request->all();
        $replies->fill($form)->save();
        $id = $request->thread_id;

        return redirect(route('content',['thread' => $id]));
    }

    public function destroy($replyId)
    {
        $reply = Reply::all();
        Reply::find($replyId)->delete();

        return redirect(route('content',['thread' => $reply->find($replyId)->thread_id]));
    }
}
