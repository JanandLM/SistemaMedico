<h1>{{ $modo }} paciente</h1>

@if(count($errors)>0)
 <div class="alert alert-danger" role="alert">
 <ul> 
  @foreach($errors->all() as $error)
  <li>   {{ $error }} </li> 
  @endforeach
  </div>
</ul> 
@endif

<div class="form-group">
<label for="Nombre"> Nombre </label>
<input type="text" class="form-control" name="Nombre" value="{{ isset($paciente->Nombre)?$paciente->Nombre:old('Nombre')}}" id="Nombre">
</div>

<div class="form-group">
<label for="Nombre"> Apellido Paterno </label>
<input type="text" class="form-control" name="ApellidoPaterno" value="{{ isset($paciente->ApellidoPaterno)?$paciente->ApellidoPaterno:old('ApellidoPaterno')}}" id="ApellidoPaterno">
</div>

<div class="form-group">
<label for="Nombre"> Apellido Materno </label>
<input type="text" class="form-control" name="ApellidoMaterno" value="{{ isset($paciente->ApellidoMaterno)?$paciente->ApellidoMaterno:old('ApellidoMaterno')}}" id="ApellidoMaterno">
</div>

<div class="form-group">
<label for="Nombre"> Curp </label>
<input type="text" class="form-control" name="Curp" value="{{ isset($paciente->Curp)?$paciente->Curp:old('Curp')}}" id="Curp">
</div>

<div class="form-group">
<label for="Nombre"> Correo </label>
<input type="text" class="form-control" name="Correo" value="{{ isset($paciente->Correo)?$paciente->Correo:old('Correo')}}" id="Correo">
</div>

<label for="Nombre"> Foto </label>
@if(isset($paciente->Foto))
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$paciente->Foto}}" width="100" alt="">
@endif
<input type="file" class="form-control" name="Foto" value="" id="Foto">
<br>
<input class="btn btn-success" type="submit" value="{{$modo}} datos">

<a class="btn btn-primary" href="{{ url('paciente/')}}">Regresar</a>
<br>