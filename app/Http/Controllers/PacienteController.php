<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['pacientes']=Paciente::paginate(5);
        return view('paciente.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paciente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Curp'=>'required|string|max:25',
            'Correo'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida',

        ];
        $this->validate($request,$campos,$mensaje);

        //$datosPaciente = request()->all();
        $datosPaciente = request()->except('_token');

        if($request->hasFile('Foto')){
            $datosPaciente['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Paciente::insert($datosPaciente);

       // return response()->json($datosPaciente);
       return redirect('paciente')->with('mensaje','Paciente agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paciente=Paciente::findOrFail($id);
        return view('paciente.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Curp'=>'required|string|max:25',
            'Correo'=>'required|email',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];

        if($request->hasFile('Foto')){
           $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
           $mensaje=['Foto.required'=>'La foto es requerida',];
        }

        $this->validate($request,$campos,$mensaje);

        $datosPaciente = request()->except('_token','_method');

        if($request->hasFile('Foto')){
            $paciente=Paciente::findOrFail($id);

            Storage::delete('public/'.$paciente->Foto);

            $datosPaciente['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Paciente::where('id','=',$id)->update($datosPaciente);
        $paciente=Paciente::findOrFail($id);
        //return view('paciente.edit', compact('paciente'));
        return redirect('paciente');
    }

    /**
     * @param \App\Models\Paciente $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente=Paciente::findOrFail($id);
        if(Storage::delete('public/'.$paciente->Foto)){
     Paciente::destroy($id);
    }
    return redirect('paciente')->with('mensaje','Paciente borrado con éxito');
    }
}
