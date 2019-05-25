<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Servicos;

class ContactosController extends Controller
{
    public function index()
    {
        return view('Contactos');
    }
    public function mensagem(Request $request)
    {
        $servico= new Servicos;
        $servico->servico="contacto";
        $servico->mensagem=$request->input('mensagem');
        $servico->nome_cliente="----------";
        $servico->email_cliente=$request->input('email');
        $servico->telefone_cliente="--------";
        $servico->visto=0;
        $servico->save();
        return redirect()->back()->with('alert', 'Mensagem Enviada!');
    }
}
