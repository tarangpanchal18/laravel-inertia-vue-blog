<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = Blog::with('user', 'comment')->where(['status' => 'Active'])->filterBlog()->orderBy('view', 'desc');

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
            'blogData' => Blog::with([
                'user',
                'comment' => function($q) {
                    $q->select(['id', 'blog_id', 'user_id', 'title', 'created_at', DB::Raw("false AS is_editing")])->where('status', 'Active');
                },
                'comment.user'
            ])->findOrFail($id)
        ]);
    }
}
