@extends('layouts.master')
@section('page_title', 'Questionnaire')

@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="well text-center mal">
        {!! HTML::image('images/icons/letter.png', null, ["width" => "100px", "height" => "100px"]) !!}

        <h3 class="mtl">Vous êtes inscrit !</h3>

        <p>Vous <strong>receverez</strong> les résultats de l'étude par e-mail.</p>

        {!! Form::open(['url' => route('unsubscribe.answerer', ['what' => 'ALR_results'])]) !!}
        <div class="form-group">
            <input name="answer_id" type="hidden" value="{{{ $answer_id }}}">
        </div>

        <hr/>
        <!-- Submit -->
        <div class='submit'>
            <button class="btn btn-xs btn-default mtl" type="submit">
                <i class="fui-mail"></i> &nbsp;Ne plus recevoir les résultats de l'étude
            </button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
