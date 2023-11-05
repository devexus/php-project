<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $events = Event::all();
        $categories = Category::all();

        return view('welcome', ['events' => $events, 'categories' => $categories]);
    }
}
