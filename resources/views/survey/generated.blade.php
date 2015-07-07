@extends('layouts.master')


@section('before-container')
    @include('survey.survey_header')
@stop

@section('content')

<!-- Show errors -->
@include('partials.form_errors_header')

<!-- Open form -->
{!! Form::open(["method" => "post", "id" => "start", "url" => "/answer", "autocomplete" => "off"]) !!}

<!-- Identifies medical center -->
{!! Form::hidden('medical_center_id', $medical_center_id) !!}

<input type='hidden' name='client_ip_address' value="{{ $_SERVER['REMOTE_ADDR'] }}"/>

<!-- Start questions listing -->
@foreach($questions as $question)
{{-- $question['field_name'] --}}
{!! $question['html'] !!}
@endforeach

<!-- Submit -->
<div class='submit'>
    <button class="btn btn-hg btn-primary btn-embossed mbl" type="submit">
        <i class="fui-check"></i> &nbsp;Envoyer le questionnaire
    </button>
</div>

<!-- Close form -->
{!! Form::close() !!}
@stop
