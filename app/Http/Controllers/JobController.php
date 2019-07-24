<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JobController extends Controller
{
    protected $job;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->job = new Job();
        $this->middleware(['auth', 'role:hr']);
    }

    /**
     * Get form for posting a job
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form()
    {
        return view ('jobs.form');
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function postJob(Request $request)
    {
        auth()->user()->saveAJob($request->all());

        return redirect('home');
    }
}
