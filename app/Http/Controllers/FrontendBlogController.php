<?php

namespace App\Http\Controllers;

use App\Models\Blogs; // Adjust the model name as needed
use App\Models\Blogcategory;
use Illuminate\Http\Request;

class FrontendBlogController extends Controller
{
    public function index(Request $request)
{
    $searchQuery = $request->input('search');

    $blogs = Blogs::when($searchQuery, function ($query) use ($searchQuery) {
        $query->where('name', 'like', '%' . $searchQuery . '%')
              ->orWhere('description', 'like', '%' . $searchQuery . '%');
    })
    ->orderBy('created_at', 'desc') // Add this line for ordering by creation date in descending order
    ->paginate(10);

    $blogcat = Blogcategory::all();
    $recentPosts = Blogs::orderBy('created_at', 'desc')->take(5)->get();
    return view("frontend.blogs.index", [
        'blogs' => $blogs,
        'blogcat' => $blogcat,
        'recentPosts' => $recentPosts,
    ]);
}


    public function show($slug)
    {
        $blog = Blogs::where('slug', $slug)->firstOrFail();

        // Fetch recent posts for the sidebar
        $recentPosts = Blogs::orderBy('created_at', 'desc')->take(5)->get();

        return view('frontend.blogs.show', [
            'blog' => $blog,
            'recentPosts' => $recentPosts,
        ]);
    }
}
