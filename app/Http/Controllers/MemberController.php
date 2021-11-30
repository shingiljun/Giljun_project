<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class MemberController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('admin-auth')
            ->only('editUsers');
        
        $this->middleware('team-member')
            ->except('editUsers');
    }

    public function show() {
        return view('index');
    }

    public function login(){
        return 'aa';
    }
}
?>