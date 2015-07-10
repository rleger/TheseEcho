@extends('layouts.master')
@section('page_title', 'Questionnaire')

@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="well text-center mal">
        {!! HTML::image('images/icons/cup.png', null, ["width" => "100px", "height" => "100px"]) !!}

        <h3 class="mtl">Merci de votre participation !</h3>
        <p>Si vous souhaitez recevoir par mail les <strong>résultats de l'étude</strong>, <br/>vous pouvez vous inscrire ci-dessous :</p>

        <hr/>

        {!! Form::open(['url' => route('subscribe.answerer', ['what' => 'Echo_results'])]) !!}
        <!-- Show errors -->
        @include('partials.form_errors_header')

        <input name="answer_id" type="hidden" value="{{{ $answer_id }}}">

        <div class="col-sm-10 col-sm-offset-1">
            <div class="form-group">
                <input name="email" type="{{{ ($email) ? 'hidden' : 'email' }}}" class="form-control email" value='{{ $email or "" }}' placeholder='Adresse e-mail'>
            </div>
        </div>

        <!-- Submit -->
        <div class='submit'>
            <button class="btn btn-lg btn-primary mtl btn-embossed" type="submit">
                <i class="fui-mail"></i> &nbsp; S'inscrire</button>
        </div>

        <hr/>
        <div class="question-info question-info" data-info-for-field="email">
            Votre adresse mail ne sera pas conservée à la fin de l'étude.
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
