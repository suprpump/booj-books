<?php

namespace App\Http\Controllers;

use App\Books;
use App\Http\Requests\BookRequestForm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = [];
        $books = null;
        if(session()->has('sort'))
        {
            $sort = session('sort');
//            if(Str::contains($sort, 'published'))
//                dd($sort);
            $books = Books::whereUserId(\Auth::user()->id)->get()->sortBy($sort);
            $books = collect($books)->chunk(2)->toArray();

        } else {
            $books = Books::whereUserId(auth()->id())->get()->chunk(2)->toArray();
        }

        $count = Books::where('user_id', '=', auth()->id())->count();
        if (isset($count))
        {
            for($i = 0; $i < $count; $i++)
            {
                $total[] = $i + 1;
            }
        } else {
            $total[] = 0;
        }

        return view('home', compact('books', 'total'));
    }
}
