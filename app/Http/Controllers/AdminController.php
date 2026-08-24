<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Tag;
use App\Models\User;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('admin/Dashboard', [
            'totalArticles' => Artikel::count(),
            'totalUsers' => User::count(),
            'totalTags' => Tag::count(),
            'trashedArticles' => Artikel::onlyTrashed()->count(),
            'recentArticles' => Artikel::with('creator')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
        ]);
    }
}