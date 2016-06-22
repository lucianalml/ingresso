@extends('layouts.master')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Registrar</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {!! csrf_field() !!}
            
            <!-- Nome Completo-->
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Nome Completo</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
           
            <!-- Email -->
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">E-mail</label>

                <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            

            <!-- Documento -->
            <div class="form-group{{ $errors->has('documento') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Documento</label>

                <div class="col-md-6">

                    <input type="text" class="form-control" name="tipo_doc" value="{{ old('tipo_documento') }}">
                    <input type="text" class="form-control" name="documento" value="{{ old('documento') }}">

                    @if ($errors->has('documento'))
                        <span class="help-block">
                            <strong>{{ $errors->first('documento') }}</strong>
                        </span>
                    @endif

                </div>
            </div>



            <!-- Senha -->
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Senha</label>

                <div class="col-md-6">
                    <input type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Confirmar senha</label>

                <div class="col-md-6">
                    <input type="password" class="form-control" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-user"></i>Registrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
