<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobFormRequest;
use Illuminate\Support\Facades\Redirect;

class JobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
     * @param JobFormRequest $request
     * @return Redirect
     */
    public function postJob(JobFormRequest $request)
    {
        auth()->user()->saveAJob($request->all());

        return redirect('home');
    }
}
