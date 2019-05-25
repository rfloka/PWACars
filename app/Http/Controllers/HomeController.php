<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $veiculos = DB::table('veiculos')
            ->join('fotos', 'veiculos.id', '=', 'fotos.veiculo_id')
            ->select('veiculos.titulo', 'veiculos.id','veiculos.preco','veiculos.created_at', 'fotos.nome')->where('fotos.head', 1)->orderBy('created_at', 'desc')
            ->get();
        return view('LandingPage')->with('veiculos',$veiculos);
    }
}
