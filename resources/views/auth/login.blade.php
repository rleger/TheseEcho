@extends('layouts.master')
@section('page_title', 'Espace sécurisé')

@section('content')
<div class="login-form well col-sm-6 col-sm-offset-3 mtl">
<div class="text-center mtl mbl">
        {!! HTML::image('images/icons/key.png', null, ["width" => "100px", "height" => "100px"]) !!}
        <h5>Connexion</h5>
        <hr/>
    </div>
    <div>
        {!! Form::open(['class' => 'normal-form', 'role' => 'form']) !!}

        <!-- Show errors -->
        @include('partials.form_errors_header')

        <div class="form-group {!! $errors->first('username', 'has-error') !!}">
            {!! Form::label('username', 'Utilisateur : ', ['class' => 'sr-only']) !!}
            {!! Form::text('username', null, ['class' => 'form-control first-focus', 'placeholder' => 'Utilisateur']) !!}
            {!! $errors->first('username', "<p class='error help-block'>:message</p>") !!}
        </div>

        <div class="form-group {!! $errors->first('password', 'has-error') !!}">
            {!! Form::label('password', 'Mot de passe : ', ['class' => 'sr-only']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de passe']) !!}
            {!! $errors->first('password', "<p class='error help-block'>:message</p>") !!}
        </div>

       <!--  <div class="form-group">
            <a href="#">Mot de passe oublié ?</a>
        </div> -->

        <div>
            {!! Form::submit('Connexion', [ 'class' => "btn btn-large btn-block btn-inverse" ] ) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
