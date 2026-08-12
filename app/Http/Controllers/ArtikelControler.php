<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArtikelController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('create.artikel', ['articles' => $articles]);
    }

    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.show', ['article' => $article]);
    }

    // Tambahkan metode lain untuk operasi CRUD lainnya sesuai kebutuhan
}
 

