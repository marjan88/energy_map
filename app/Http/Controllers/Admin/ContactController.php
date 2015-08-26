<?php

namespace App\Http\Controllers\Admin;
use Input;
use App\Post;
use App\Http\Controllers\AdminController;

class ContactController extends AdminController {
    /*
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index() {
        $content = Post::where('name', 'contact')->first();
        // Show the page
        return view('admin.contact.index', compact('content'));
    }

    public function store() {
        $post = new Post();
        $post->name = 'contact';
        $post->content = Input::get('text');
        $post->save();
        return back()->with('success', 'Page has been saved');
    }

}
