<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use App\User;
//use App\Plant;
use LaravelAnalytics;

class DashboardController extends AdminController {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $title = "Welcome, " . \Auth::user()->name;
        $users = User::count();
        $lastUsers = User::orderBy('last_login', 'desc')->take(10)->get();
//        $analyticsData = LaravelAnalytics::setSiteId('ga:12345678')->getVisitorsAndPageViews(7);
        
//        $plants = Plant::count();
	return view('admin.dashboard.index',  compact('title','users', 'lastUsers'));
	}
}