<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoController extends Controller
{
    public function favo(){
        return view('favo.favo');
    }
}
