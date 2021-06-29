<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function upload(Request $req)
    {
        $path = $req->file('berkas')->storeAs('', $req->file('berkas')->getClientOriginalName(), 'public');

        return view('hasil-upload', ['path' => $path]);
    }

    public function unduh($path) {
        return Storage::download('public/' . $path);
        }
      
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
