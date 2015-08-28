<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use App\User;
use App\Plant;


class DashboardController extends AdminController {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $title = "Dashboard";
        $users = User::count();
        $lastUsers = User::orderBy('last_login', 'desc')->take(10)->get();
        
//        $plants = Plant::count();
	return view('admin.dashboard.index',  compact('title','users', 'lastUsers'));
	}
}