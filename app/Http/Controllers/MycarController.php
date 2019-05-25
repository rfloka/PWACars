<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class MycarController extends Controller
{
    public function index()
    {
        if (!Auth::check())  {
            return redirect('/')->with('status', 'Faça login');
        }
        return view('mycar.Filters');
    }
    public function mycartinder(Request $request)
    {
        if (!Auth::check())  {
            return redirect('/')->with('status', 'Faça login');
        }
        $colecao = DB::table('colecao')->where('user_id','=', Auth::user()->id)->pluck('veiculo_id');
        $viaturas = DB::table('veiculos')
        ->join('fotos', 'veiculos.id', '=', 'fotos.veiculo_id')
        ->select('veiculos.titulo','veiculos.id','veiculos.preco', 'fotos.nome')->where('fotos.head','=', 1)->whereNotIn('veiculos.id',$colecao);
      if ($request->input('Tipo_viatura')!= null) {
         $viaturas = $viaturas->where('veiculos.tipo_viatura',$request->input('Tipo_viatura'));
      }
      if ($request->input('tipo_carro')!= null) {
        $viaturas = $viaturas->where('veiculos.tipo',$request->input('tipo_carro'));
        }
      if ($request->input('preco_min')!= null || $request->input('preco_max')!= null) {
        $preco_min = $request->input('preco_min') ? $request->input('preco_min'):0;
        $preco_max = $request->input('preco_max') ? $request->input('preco_max'):9999999;
        $pmin = (int)$preco_min;
         $pmax = (int)$preco_max;
        $viaturas = $viaturas->whereBetween('veiculos.preco', [$pmin, $pmax]);
      }
      if ($request->input('ano_min')!= null || $request->input('ano_max')!= null) {
        $ano_min = $request->input('ano_min') ? $request->input('ano_min'):1900;
        $ano_max = $request->input('ano_max') ? $request->input('ano_max'):2060;
        $amin = "1/1/".$ano_min;
        $amax = "31/12".$ano_max;
        $viaturas = $viaturas->whereBetween('veiculos.registo', [$ano_min, $ano_max]);
      }
      if ($request->input('km_min')!= null || $request->input('km_max')!= null) {
        $km_min = $request->input('km_min') ? $request->input('km_min'):0;
        $km_max = $request->input('km_max') ? $request->input('km_max') :9999999;
        $kmin = (int)$km_min;
        $kmax = (int)$km_max;
        $viaturas = $viaturas->whereBetween('veiculos.km', [$kmin, $kmax]);
      }
      if ($request->input('combus') != null) {
        $combus = $request->input('combus');  
        $viaturas = $viaturas->whereIn('veiculos.combustivel',$combus);
      }
      
      switch ($request->input('ordenar')) {
        case 'created_at':
            $viaturas = $viaturas->orderBy('veiculos.created_at', 'desc')->get();
        break;
        case 'newcar':
            $viaturas = $viaturas->orderBy('veiculos.registo', 'desc')->get();
        break;
        case 'oldcar':
            $viaturas = $viaturas->orderBy('veiculos.registo','asc')->get();
        break;
        case 'cheap':
            $viaturas = $viaturas->orderBy('veiculos.preco','asc')->get();
        break;
        case 'expensive':
            $viaturas = $viaturas->orderBy('veiculos.preco','desc')->get();
        break;
        default:
        $viaturas = $viaturas->orderBy('veiculos.created_at', 'desc')->get();
        break;
      }
      return view('mycar.MyCar',['viaturas'=>$viaturas]);
    }
    public function addmycar(Request $request)
    {
        if (!Auth::check())  {
            return redirect('/')->with('status', 'Faça login');
        }
        $userid = Auth::id();
        foreach ($request->id as $id) {
        $check = DB::table('colecao')->where('user_id','=', Auth::user()->id)->where('veiculo_id', '=', $id)->get();
        if ( $check->isEmpty()) {
            DB::insert('insert into colecao (user_id,veiculo_id) values (?,?)', [$userid, $id]);
        }
        }
    }
    public function fav(Request $request)
    {
        if (!Auth::check())  {
            return redirect('/')->with('status', 'Faça login');
        }
        $userid = Auth::id();
        DB::insert('insert into colecao (user_id,veiculo_id) values (?,?)', [$userid, $request->id]);
    }
    public function unfav(Request $request)
    {
        if (!Auth::check())  {
            return redirect('/')->with('status', 'Faça login');
        }
        $userid = Auth::id();
        DB::delete('delete from colecao where veiculo_id = ? AND user_id= ?', [$request->id, $userid]);
    }
}
