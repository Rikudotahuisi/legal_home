<?php

namespace App\Http\Controllers\AdminSpace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function view_create()
    {
    	return view("panel.article.create");
    }

    public function view_update()
    {
    	return view("panel.article.update");
    }

    public function view_list()
    {
    	return view("panel.article.list");
    }

    public function post_delete(Request $request){
    	echo "Rey's work";
    }

    public function post_create(Request $request){
    	echo "Rafi's work";
    }

    public function post_update(Request $request){
    	echo "Rey's work";
    }
}
