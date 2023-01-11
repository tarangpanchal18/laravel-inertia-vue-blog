<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Retrive blogs data for Home page
     *
     * @param Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $data = Blog::with('user')->where(['status' => 'Active'])->filterBlog()->orderBy('view', 'desc');

        return Inertia::render('Welcome', [
            'blogs' => $data->paginate(10),
            'search' => [
                'q' => $request->get('q')
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer  $id
     * @return \Inertia\Inertia
     */
    public function show($id)
    {
        return Inertia::render('BlogDetail', [
            'blogData' => Blog::with('user')->findOrFail($id)
        ]);
    }
}
