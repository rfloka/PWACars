<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicos;

class ServicosController extends Controller
{
    public function index()
    {
        return view('Servicos');
    }
    public function enviar(Request $request)
    {
        switch ($request->input('servicos')) {
            case 'consultoria auto':
                $mensagem = "Marca: ".$request->input('marca')."|| Modelo:".$request->input('modelo')."||Versão: ".$request->input('versao')."|| Ano Minimo: ".$request->input('ano_min')."||KM maximos: ".$request->input('km_max')."||Combustivel: ".$request->input('combustivel')."||Transmissão: ".$request->input('transmissao')."||Cilindrada: ".$request->input('cilindrada')."||Mensagem: ".$request->input('mensagem');
                break;
            case 'financiamento':
                $mensagem = "Preço: ".$request->input('preco')."||Entrada Inicial: ".$request->input('entrada_ini')."||Prazo: ".$request->input('prazo')."||Mensagem: ".$request->input('mensagem');
                break;
            case 'importados':
                $mensagem = "Marca: ".$request->input('marca1')."||Modelo: ".$request->input('modelo1')."||Versão: ".$request->input('versao1')."||Ano: ".$request->input('ano1')."||Pais: ".$request->input('pais')."||Mensagem: ".$request->input('mensagem');
                break;
            case 'extras':
                $mensagem = "Marca: ".$request->input('marca2')."||Modelo: ".$request->input('modelo2')."||Versão: ".$request->input('versao2')."||Mensagem: ".$request->input('mensagem');
                break;
            case 'manutencao':
                $mensagem = "Marca: ".$request->input('marca3')."||Modelo: ".$request->input('modelo3')."||Mensagem: ".$request->input('mensagem');
                break;
        }
        $servico= new Servicos;
        $servico->servico=$request->input('servicos');
        $servico->mensagem=$mensagem;
        $servico->nome_cliente=$request->input('name');
        $servico->email_cliente=$request->input('email');
        $servico->telefone_cliente=$request->input('telefone');
        $servico->visto=0;
        $servico->save();
        return redirect()->back()->with('alert', 'Mensagem Enviada!');
    }
}
