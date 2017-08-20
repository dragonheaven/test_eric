<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Blog;
use Carbon\Carbon;
use Auth;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs');
    }

    public function list()
    {
        // Get list of blogs
        $blogs = Blog::orderBy('updated_at', 'DESC')
            ->with('user')
            ->get()->toArray();

        foreach ($blogs as $key => $blog) {
            $blogs[$key]['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $blog['created_at'], 'UTC')->setTimezone(Auth::user()->timezone)->toDateTimeString();
            $blogs[$key]['updated_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $blog['updated_at'], 'UTC')->setTimezone(Auth::user()->timezone)->toDateTimeString();
        }

        return response()->json($blogs);
    }

    public function create(Request $request)
    {
        $request->slug = str_slug($request->slug, '-');

        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:blogs',
            'content' => 'required',
        ]);

        Blog::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->get('content'),
        ]);

        return response()->json([
            'success' => true
        ], 200);
    }

    public function get(Request $request, $id)
    {
        $blog = Blog::findOrFail($id)->toArray();

        return response()->json($blog);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->slug = str_slug($request->slug, '-');

        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
        ]);

        $blog->update([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->get('content'),
        ]);

        return response()->json([
            'success' => true
        ], 200);
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);

        $blog->delete();
        return response()->json(['success' => true], 200);
    }

    public function viewBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->get()->first();
        return view('blog-view')
            ->with('blog', $blog);
    }

    public function publicList()
    {
        $blogs = Blog::orderBy('updated_at', 'DESC')
            ->with('user')
            ->get()->toArray();

        return view('welcome')
            ->with('blogs', $blogs);
    }
}
