<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;

class BlogController extends Controller
{
    protected $blog;
    public function __construct()
    {
        $this->blog = new Blog();
    }
    public function index()
    {
        $blogs = Blog::with('user')->get();
        return $blogs;
       
    }

    public function store(Request $request)
    {
        return $this->blog->create($request->all());
    }

    public function show(string $id)
    {
        $blog = Blog::with('user')->find($id); // Eager loading user data

        return $blog;
    }

    public function update(Request $request, string $id)
    {
        $blog = $this->blog->find($id);
        $blog->update($request->all());
        return $blog;
    }
    public function destroy(string $id)
    {
        $blog = $this->blog->find($id);
        return $blog->delete();
    }
    public function addComment(Request $request, Blog $blog)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $comment = $blog->comment($request->input('body'));

        return response()->json($comment, 201);
    }
}
