<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class ThreadController extends Controller
{
    public function index(Request $request)
    {
        $user = [
            'name' => Cookie::get('bbs-app_name'),
            'identifier' => Cookie::get('bbs-app_identifier'),
        ];

        if ($user['name'] === null) {

            $user = [
                'name' => 'Guest',
                'identifier' => Str::random(20),
            ];

            Cookie::queue(Cookie::forever('bbs-app_name', $user['name']));
            Cookie::queue(Cookie::forever('bbs-app_identifier', $user['identifier']));
        }

        $threads = Thread::orderBy('created_at', 'desc')->paginate(5);

        return view('bbs/index', compact('threads', 'user'));
    }

    public function store(Request $request)
    {
        $threads = new Thread;
        $form = $request->all();
        $threads->fill($form)->save();

        return redirect(route('thread.index'));
    }

    public function destroy($id)
    {

        $thread = Thread::find($id)->delete();


        return redirect(route('thread.index'));
    }

    public function content($thread)
    {
        $user = [
            'name' => Cookie::get('bbs-app_name'),
            'identifier' => Cookie::get('bbs-app_identifier'),
        ];

        if ($user['name'] === null) {

            $user = [
                'name' => 'Guest',
                'identifier' => Str::random(20),
            ];

            Cookie::queue(Cookie::forever('bbs-app_name', $user['name']));
            Cookie::queue(Cookie::forever('bbs-app_identifier', $user['identifier']));
        }

        $threads = Thread::find($thread);

        $replies = Reply::get();

        return view('bbs/content', [
            'threads' => $threads,
            'user' => $user,
            'replies' => $replies
        ]);
    }
}
