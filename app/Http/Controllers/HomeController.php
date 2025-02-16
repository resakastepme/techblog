<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now()->format('d F Y');
        $forSliders = Post::inRandomOrder()->limit(5)->get();
        $forPosts = Post::orderBy('id', 'desc')->with(['user', 'comments'])->paginate(5);
        return view('index')->with([
            'date' => $currentDate,
            'forSliders' => $forSliders,
            'forPosts' => $forPosts
        ]);
    }
}
