@extends('admin.layouts.master')

@section('content')


<a href="{{ url('admin/evento/'.$evento->id.'/edit') }}" class="btn btn-primary">Voltar</a>
<br><br>

@include('admin.lotes.evento-lotes')

@endsection