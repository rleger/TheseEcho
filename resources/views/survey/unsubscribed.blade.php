@extends('layouts.master')
@section('page_title', 'Questionnaire')

@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="well text-center mal">
        {!! HTML::image('images/icons/letter.png', null, ["width" => "100px", "height" => "100px"]) !!}

        <h3 class="mtl">Vous n'êtes plus inscrit !</h3>
        <p>Vous <strong>ne receverez pas</strong> les résultats de l'étude sur le mail.</p>
    </div>
</div>
@stop
