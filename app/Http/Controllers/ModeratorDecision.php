<?php

namespace App\Http\Controllers;

use App\Job;
use App\User;

class ModeratorDecision extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:moderator']);
    }

    /**
     * @param User $user
     * @param Job $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function approve(User $user, Job $data)
    {
        $data->approved = true;
        $data->save();

        return view('home');
    }

    public function spam(User $user, Job $data)
    {
        $data->delete();

        return view('home');
    }
}
