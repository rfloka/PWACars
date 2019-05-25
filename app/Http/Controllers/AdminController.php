<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Veiculos;
use App\User;
use App\Servicos;
use DB;
use Storage;

class AdminController extends Controller
{
    //dashboard
    public function index()
    {
        if (!Auth::check() or Auth::user()->role == "0"  )  {
            return redirect('/');
        }
        $likes = DB::table('colecao')->select(DB::raw('count(*) as fav,veiculo_id'))->groupBy('veiculo_id')->orderBy('fav','desc')->limit(1)->pluck('fav');
        $favcar = DB::table('colecao')->select(DB::raw('count(*) as fav,veiculo_id'))->groupBy('veiculo_id')->orderBy('fav','desc')->limit(1)->pluck('veiculo_id');
        $users= User::count();
        $veiculos= Veiculos::count();
        $bestcar = Veiculos::find($favcar);
        $servicos = Servicos::where('visto', 0)->count();
        return view('dashboard.SiteDash',['users' => $users,'veiculos'=>$veiculos,'bestcar'=>$bestcar,'likes'=>$likes,'servicos'=>$servicos]);
    }
    //viaturas
    public function indexviaturas()
    {
        if (!Auth::check() or Auth::user()->role == "0"  )  {
            return redirect('/');
        }
        $veiculos = Veiculos::all();
        return view('dashboard.Viaturas',['veiculos' => $veiculos]);
    }
    public function addviatura()
    {
        if (!Auth::check() or Auth::user()->role == "0"  )  {
            return redirect('/');
        }
        $veiculos = Veiculos::all();
        return view('dashboard.AddViatura');
    }
    public function guardarviatura(Request $request){
        $request->validate([
            'titulo' => 'required|max:50|min:3',
            'marca' => 'required|max:50|min:3',
            'modelo' => 'required|max:50|min:2',
            'preco' => 'required',
            'km' => 'required',
            'registo' => 'required',
            'cilindrada' => 'required',
            'potencia' => 'required',
        ]);
        $viatura = new Veiculos;
        if ($request->input('Tipo_viatura') == 'Carro') {
            $tipo_viatura = $request->input('tipo_carro');
            $tracao = $request->input('tracao');
            $caixa = $request->input('caixa');
        } else {
            $tipo_viatura = $request->input('tipo_mota');
            $tracao = $request->input('tracao_mota');
            $caixa = $request->input('caixa_mota');
        }
        $viatura->tipo_viatura = $request->input('Tipo_viatura');
        $viatura->titulo = $request->input('titulo');
        $viatura->marca = $request->input('marca');
        $viatura->modelo = $request->input('modelo');
        $viatura->tipo = $tipo_viatura;
        $viatura->preco = $request->input('preco');
        $viatura->combustivel = $request->input('combustivel');
        $viatura->km = $request->input('km');
        $viatura->registo = $request->input('registo');
        $viatura->cor = $request->input('cor');
        $viatura->cilindrada = $request->input('cilindrada');
        $viatura->potencia = $request->input('potencia');
        $viatura->garantia = $request->input('garantia');
        $viatura->portas = $request->input('portas');
        $viatura->caixa = $caixa;
        if ($request->input('extra')){
            $viatura->extras = $request->input('extra');
        }else{
            $viatura->extras = "Sem Extras";
        }
        
        $viatura->lotacao = $request->input('lotacao');
        $viatura->tracao = $tracao;
        $viatura->fumador = $request->input('fumador');
        $viatura->user_id = auth()->user()->id;
        $viatura->save();
        $viaturaID = $viatura->id;     
        $fotos = $request->file('fotos');
        if(!empty($fotos)):
            $i=0;
            foreach ($fotos as $foto) {
                $id =random_int(1, 999);
                $i++;
                $nome = $request->input('marca').$request->input('modelo').$i."_".$id.".".$foto->getClientOriginalExtension();
                Storage::put("/public/upload/viaturaspics/$nome", file_get_contents($foto));
                DB::insert('insert into fotos (nome,veiculo_id,head) values (?,?,?)', [$nome, $viaturaID,0]);

            }
        else:
            DB::insert('insert into fotos (nome,veiculo_id,head) values (?,?,?)', ["holder", $viaturaID,1]);
        endif;
        return redirect()->back()->with('alert', 'Viatura Adicionada! Escolha uma Foto Principal');
    }
    public function editviatura($id)
    {
        $viatura = Veiculos::find($id);
        $fotos = DB::select('select * from fotos where veiculo_id = :id ',['id' => $id]);
        return view('dashboard.EditViatura',['viatura' => $viatura],['fotos' => $fotos]);
    }
    public function updateviatura(Request $request,$id)
    {
        $request->validate([
            'titulo' => 'required|max:50|min:3',
            'marca' => 'required|max:50|min:3',
            'modelo' => 'required|max:50|min:2',
            'preco' => 'required',
            'km' => 'required',
            'registo' => 'required',
            'cilindrada' => 'required',
            'potencia' => 'required',
        ]);
        $viatura = Veiculos::find($id);
        if ($request->input('Tipo_viatura') == 'Carro') {
            $tipo_viatura = $request->input('tipo_carro');
            $tracao = $request->input('tracao');
            $caixa = $request->input('caixa');
        } else {
            $tipo_viatura = $request->input('tipo_mota');
            $tracao = $request->input('tracao_mota');
            $caixa = $request->input('caixa_mota');
        }
        $viatura->tipo_viatura = $request->input('Tipo_viatura');
        $viatura->titulo = $request->input('titulo');
        $viatura->marca = $request->input('marca');
        $viatura->modelo = $request->input('modelo');
        $viatura->tipo = $tipo_viatura;
        $viatura->preco = $request->input('preco');
        $viatura->combustivel = $request->input('combustivel');
        $viatura->km = $request->input('km');
        $viatura->registo = $request->input('registo');
        $viatura->cor = $request->input('cor');
        $viatura->cilindrada = $request->input('cilindrada');
        $viatura->potencia = $request->input('potencia');
        $viatura->garantia = $request->input('garantia');
        $viatura->portas = $request->input('portas');
        $viatura->caixa = $request->input('caixa');
        $viatura->extras = $caixa;
        $viatura->lotacao = $request->input('lotacao');
        $viatura->tracao = $tracao;
        $viatura->fumador = $request->input('fumador');
        $viatura->user_id = auth()->user()->id;
        $viatura->save();
        $viaturaID = $viatura->id;
        echo ($viaturaID);        
        $fotos = $request->file('fotos');
        if(!empty($fotos)):
            $i=0;
            foreach ($fotos as $foto) {
                $id =random_int(1, 999);
                $i++;
                $nome = $request->input('marca').$request->input('modelo').$i."_".$id.".".$foto->getClientOriginalExtension();
                Storage::put("/public/upload/viaturaspics/$nome", file_get_contents($foto));
                DB::insert('insert into fotos (nome,veiculo_id,head) values (?,?,?)', [$nome, $viaturaID,0]);
            }
        endif;
        return redirect()->back()->with('alert', 'Viatura Modificada!');
    }
    public function deletefoto($id){
        $foto = DB::table('fotos')->where('id', $id)->pluck('nome')->first();
        if($foto != 'holder'){
            Storage::delete('/public/upload/viaturaspics/'.$foto);
        }
        $deleted = DB::delete('delete from fotos where id = ?', [$id]);
        return redirect()->back()->with('alert', 'Foto Eliminada');
    }

    public function changefoto($id)
    {
        $veiculo_id =  DB::table('fotos')->where('id', $id)->pluck('veiculo_id');
        DB::table('fotos')
            ->where([['veiculo_id', $veiculo_id],['head',1]])
            ->update(['head' => 0]);
        DB::table('fotos')
            ->where('id',$id)
            ->update(['head' => 1]);
        return redirect()->back()->with('alert', 'Foto Principal Modificada');
    }

    public function deleteviatura($id){
        $nomes =  DB::table('fotos')->where('veiculo_id', $id)->pluck('nome');
        foreach ($nomes as $nome) {
            Storage::delete('/public/upload/viaturaspics/'.$nome);
        }
        $deleted = DB::delete('delete from fotos where veiculo_id = ?', [$id]);
        $viatura = Veiculos::find($id);
        $viatura->delete();
        return redirect('/admin/viaturas')->with('success', 'Viatura Removida');
    }
    //utilizadores
    public function indexusers(){
        if (!Auth::check() or Auth::user()->role == "0"  )  {
            return redirect('/');
        }
        $users = User::all();
        return view('dashboard.Utilizadores',['users' => $users]);
    }
    public function userperfil($id){
        $user = User::find($id);
        $veiculos = DB::table('veiculos')
            ->join('fotos', 'veiculos.id', '=', 'fotos.veiculo_id')
            ->join('colecao', 'veiculos.id', '=', 'colecao.veiculo_id')
            ->select('veiculos.*', 'fotos.nome')->where('fotos.head', 1)->where('colecao.user_id', $user->id)->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard.Perfil',['viaturas' => $veiculos,'user'=> $user]);
    }
    public function rolemod(Request $request){
        $user = User::find($request->input('userid'));
        $user->role = $request->input('role');
        $user->save();
        return redirect('/admin/users')->with('alert', 'Utilizador Modificado');
    }
    public function deleteusers($id){
        $user = User::find($id);
        if ($user->avatar != "default.png" ) {
            Storage::delete('/public/upload/profilepics/'.$user->avatar);
        }
        $user->delete();
        return redirect('/admin/users')->with('success', 'Utilizador Removido');
    }
    //servicos
    public function indexservicos(){
        if (!Auth::check() or Auth::user()->role == "0"  )  {
            return redirect('/');
        }
        $servicos = Servicos::all();
        return view('dashboard.Servicos',['servicos' => $servicos]);
    }
    public function deleteservico($id){
        if (!Auth::check() or Auth::user()->role == "0"  )  {
            return redirect('/');
        }
        $servicos = Servicos::find($id);
        $servicos->delete();
        return redirect('/admin/servicos')->with('success', 'Utilizador Removido');
    }
    public function verservico($id){
        if (!Auth::check() or Auth::user()->role == "0"  )  {
            return redirect('/');
        }
        $servicos = Servicos::find($id);
        $servicos->visto = 1;
        $servicos->save();
        $info = explode("||", $servicos->mensagem);
        return view('dashboard.VerServico',['servicos' => $servicos,'info'=>$info]);
    }
}
