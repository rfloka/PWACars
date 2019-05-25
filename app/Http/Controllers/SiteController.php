<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Storage;
use App\User;

class SiteController extends Controller
{
    public function landing()
    {
        $veiculos = DB::table('veiculos')
            ->join('fotos', 'veiculos.id', '=', 'fotos.veiculo_id')
            ->select('veiculos.titulo', 'veiculos.id','veiculos.preco','veiculos.created_at', 'fotos.nome')->where('fotos.head', 1)->orderBy('created_at', 'desc')
            ->get();
        return view('LandingPage')->with('veiculos',$veiculos);
    }
    //perfil
    public function perfil()
    {
        if(!Auth::check())
        {
            return redirect('/')->with('status', 'Tem que entrar com a sua conta');
        }

        $veiculos = DB::table('veiculos')
            ->join('fotos', 'veiculos.id', '=', 'fotos.veiculo_id')
            ->join('colecao', 'veiculos.id', '=', 'colecao.veiculo_id')
            ->select('veiculos.*', 'fotos.nome')->where('fotos.head', 1)->where('colecao.user_id', Auth::user()->id)->orderBy('created_at', 'desc')
            ->get();
        return view('Perfil')->with('viaturas',$veiculos);
    }
    public function deletecarperf($id)
    {
        $userid = Auth::id();
        $deleted = DB::delete('delete from colecao where veiculo_id = ? AND user_id= ?', [$id, $userid]);
        return redirect('/perfil')->with('success', 'Viatura Removida');
    }
    public function updateavatar(Request $request)
    {   $user = Auth::user();
        if ($user->avatar != "default.png" ) {
            Storage::delete('/public/upload/profilepics/'.$user->avatar);
        }
        $fotos = $request->file('avatar');
        if(!empty($fotos)){
             $id =random_int(1, 999);
            $nome =  Auth::user()->name.$id.".".$fotos->getClientOriginalExtension();
            Storage::put("/public/upload/profilepics/$nome", file_get_contents($fotos));
            $user = Auth::user();
            $user->avatar = $nome;
            $user->save();
            return redirect('/perfil')->with('success', 'Foto modificada');
        }    
        return redirect('/perfil')->with('erro', 'Ocorreu um erro');
    }
}
