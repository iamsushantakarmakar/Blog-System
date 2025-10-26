<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = Cache::remember('user_stats_' . $user->id, 600, function () use ($user) {
            return [
                'total_posts' => $user->posts()->count(),
                'total_comments' => $user->comments()->count(),
                'recent_posts' => $user->posts()->with('comments')->latest()->take(5)->get(),
            ];
        });

        return view('user.dashboard', $stats);
    }
}
