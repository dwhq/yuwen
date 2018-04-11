<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class vipController extends Controller
{
    //
    public function logout(Request $request,$tag_id)
    {
        $request->session()->forget('user_id');
        return redirect()->back();
    }
}
