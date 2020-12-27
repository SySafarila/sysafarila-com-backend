<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post as ResourcesPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('origin');
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);

        // $arr = array();

        // foreach ($posts as $post) {
        //     array_push($arr, [
        //         'id' => $post->id,
        //         'title' => $post->title,
        //         'body' => $post->body,
        //         'user_email' => $post->user_email,
        //         'time' => $post->time,
        //         'created_at' => $post->created_at->diffForHumans(),
        //         'updated_at' => $post->updated_at->diffForHumans()
        //     ]);
        // }

        // return response()->json($origin = request()->server('HTTP_REFERER'));
        return response()->json($posts);
    }

    public function sitemap()
    {
        $posts = Post::all();

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'user_email' => 'required|email'
        ]);

        // return $validator;
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()
            ], 200);
        }

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_email' => $request->user_email,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Store successfully !'
        ]);
    }

    public function show(Post $post)
    {
        return response()->json($post);
    }

    public function update(Post $post, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'user_email' => 'required|email'
        ]);

        // return $validator;
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()
            ], 200);
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'user_email' => $request->user_email,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post updated !'
        ]);
    }
}
