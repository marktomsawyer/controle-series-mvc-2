<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use DB;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    //
    public function index(Request $request)
    {
        //$series = DB::select('select * from series');
        //$series = Serie::All();
        //dd($series);

        $series = Serie::query()->orderBy('nome')->get();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        Serie::create($request->all());
        $request->session()->flash('mensagem.sucesso' , 'Série adicionada com sucesso!');
        //return redirect('/series');
        //return redirect(route('series.index'));
        return to_route('series.index');
    }

    public function destroy(Request $request)
    {
        //dd($request->route());
        Serie::destroy($request->series);
        $request->session()->flash('mensagem.sucesso', 'Série removida com sucesso!');


        return to_route('series.index');
    }
}
