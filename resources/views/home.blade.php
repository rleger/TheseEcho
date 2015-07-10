@extends('layouts.master')
@section('page_title', 'Questionnaire')

@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="well text-center mal">
        {!! HTML::image('images/icons/rocket.png', null, ["width" => 100, "height" => 100]) !!}

        <h4 class="mtl">Titre</h4>

        <p>
        Description
        </p>

    </div>
</div>
@stop
