<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Veiculos;
use App\Servicos;
use DB;
use Auth;

class ViaturasController extends Controller
{
    public function index()
    {
        
        $marca = DB::table('veiculos')->select('marca')->get();
        $filtromarcas = $marca->unique()->values()->all();
        $viaturas = DB::table('veiculos')
            ->join('fotos', 'veiculos.id', '=', 'fotos.veiculo_id')
            ->select('veiculos.*', 'fotos.nome')->where('fotos.head', 1)->orderBy('created_at', 'desc')
            ->get();
        return view('viaturas.Index',['viaturas'=>$viaturas, 'filtromarcas'=>$filtromarcas]);
    }
    public function showviatura($id)
    {
        $mycar = false;
        if (Auth::check()) {
          $mycarquery = DB::table('colecao')->where('veiculo_id',$id)->where('user_id',Auth::user()->id)->get();
          if (count($mycarquery) !== 0) {
            $mycar = true;
          }
        }
       
        $viaturas = DB::table('veiculos')->where('veiculos.id', $id)->first();
        $fotos =  DB::table('fotos')->where('veiculo_id', $id)->get();           
        return view('viaturas.viatura',['viaturas'=>$viaturas,'fotos'=>$fotos,'mycar'=>$mycar]);
    }  

    public function search()
    {
        $marca = DB::table('veiculos')->select('marca')->get();
        $filtromarcas = $marca->unique()->values()->all();
        $search = $_GET['search'];
        $viaturas = DB::table('veiculos')
            ->join('fotos', 'veiculos.id', '=', 'fotos.veiculo_id')
            ->select('veiculos.*', 'fotos.nome')->where([['fotos.head','=', 1],['veiculos.titulo','like', '%'.$search.'%']])->orderBy('created_at', 'desc')
            ->get();
        return view('viaturas.Index',['viaturas'=>$viaturas, 'filtromarcas'=>$filtromarcas]);
    }
    public function filtros(Request $request)
    {
        $marca = DB::table('veiculos')->select('marca')->get();
        $filtromarcas = $marca->unique()->values()->all();
        $viaturas = DB::table('veiculos')
        ->join('fotos', 'veiculos.id', '=', 'fotos.veiculo_id')
        ->select('veiculos.*', 'fotos.nome')->where('fotos.head','=', 1);
      if ($request->input('Tipo_viatura')!= null) {
         $viaturas = $viaturas->where('veiculos.tipo_viatura',$request->input('Tipo_viatura'));
      }
      if ($request->input('Marca')!= null) {
        $viaturas = $viaturas->where('veiculos.marca',$request->input('Marca'));
      }
      if ($request->input('modelo')!= null) {
        $viaturas = $viaturas->where('veiculos.modelo',$request->input('modelo'));
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
      return view('viaturas.Index',['viaturas'=>$viaturas, 'filtromarcas'=>$filtromarcas]);
    }
    public function contactar(Request $request)
    {
      $servico= new Servicos;
      $servico->servico="contacto_compra";
      $servico->mensagem=$request->input('id')."||".$request->input('marca')."||".$request->input('modelo')."||".$request->input('mensagem');
      $servico->nome_cliente=$request->input('name');
      $servico->email_cliente=$request->input('email');
      $servico->telefone_cliente=$request->input('telefone');
      $servico->visto=0;
      $servico->save();
      return redirect()->back()->with('alert', 'Mensagem Enviada!');
    }
}
