@extends('layouts.app')
@section('content')
<div class="container">


@if(Session::has('mensaje'))
{{ Session::get('mensaje')}}
@endif




<a href="{{ url('paciente/create')}}" class="btn btn-success">Registrar nuevo paciente </a>
</br>
</br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Curp</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach( $pacientes as $paciente )
        <tr>
            <td>{{$paciente->id }}</td>

            <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$paciente->Foto}}" width="100" alt="">
            </td>

            <td>{{$paciente->Nombre }}</td>
            <td>{{$paciente->ApellidoPaterno }}</td>
            <td>{{$paciente->ApellidoMaterno }}</td>
            <td>{{$paciente->Curp }}</td>
            <td>{{$paciente->Correo }}</td>
            <td>
                
            <a href=" {{ url('/paciente/'.$paciente->id.'/edit') }} " class="btn btn-warning">
                 Editar 
            </a>
            |
            <form action="{{ url('/paciente/'.$paciente->id ) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}
            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')"
            value="Borrar">

            </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection