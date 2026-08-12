<?php

namespace App\Http\Controllers\AdminSpace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function view_create()
    {
    	return view("panel.license.create");
    }

    public function view_update()
    {
    	return view("panel.license.update");
    }

    public function view_list()
    {
    	return view("panel.license.list");
    }

    public function post_delete(Request $request){
    	echo "Rey's work";
    }

    public function post_create(Request $request){
    	echo "Rey's Work";
    }

    public function post_update(Request $request){
    	echo "Rey's work";
    }
}
