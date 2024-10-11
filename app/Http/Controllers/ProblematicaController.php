<?php

namespace App\Http\Controllers;

use App\Models\Problematica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ProblematicaController extends Controller
{

   /*  VISTA PROBLEMATICA */
    public function index(){
        Gate::allowIf(Auth::user()->usertype == "encargado" || Auth::user()->usertype == "gestec");
        $problematicas = Problematica::all();

        return view('profile.addproblem', compact('problematicas'));
    }

/* GUARDA PROBLEMATICA */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'max:100']
        ]);          

        $problematica = new Problematica();
        $problematica->nombre = $request->nombre;
        $problematica->save();

        return redirect()->back();
    }
    /* ELIMINA PROBLEMATICA */
    public function delete(String $id)
    {
        $problematica = Problematica::findOrFail($id);
        $problematica->delete();

        return redirect()->back();

    }
    /* EDITA PROBLEMATICA */
    public function update(Request $request, String $id)
    {
        $problematica = Problematica::findOrFail($id);
        $problematica->nombre = $request->nombre;
        $problematica->save();

        return redirect()->back();

    }
    

}
