@extends('layouts.master')
@section('page_title', 'Erreur')

@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="well text-center mal">
        {!! HTML::image('images/icons/patch1x.png') !!}

        <h1 class="mtl">Oups !</h1>

        <p>{{ $message }}</p>
    </div>
</div>
@stop

