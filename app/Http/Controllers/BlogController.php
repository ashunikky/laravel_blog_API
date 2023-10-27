<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    protected $blog;
    public function __construct()
    {
        $this->blog = new Blog();
    }
    public function index()
    {
        return $this->blog->all();
    }

    public function store(Request $request)
    {
        return $this->blog->create($request->all());
    }

    public function show(string $id)
    {
        $blog = $this->blog->find($id);
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
}
