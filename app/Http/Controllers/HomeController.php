<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profil()
    {
        return view('pages.profil');
    }
    public function ubah(Request $request)
    {
        $iduser = $request->iduser;
        $passwordbaru = Hash::make($request->password);
        
        User::where("idusers", $iduser)->first()->update([
            "password" => $passwordbaru,
        ]);

        return redirect()->back()->with('success', 'Success, silahkan logout dan login ulang');
    }
}
