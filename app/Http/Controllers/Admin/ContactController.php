<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class ContactController extends AdminController {
    /*
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index() {
        // Show the page
        return view('admin.contact.index');
    }



}
