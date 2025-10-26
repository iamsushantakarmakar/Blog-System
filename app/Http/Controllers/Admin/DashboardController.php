<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('admin_stats', 600, function () {
            return [
                'total_posts' => Post::count(),
                'total_users' => User::count(),
                'total_comments' => Comment::count(),
                'recent_posts' => Post::with('user')->latest()->take(5)->get(),
                'recent_users' => User::latest()->take(5)->get(),
            ];
        });

        return view('admin.dashboard', $stats);
    }
}
