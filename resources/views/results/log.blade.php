@extends('layouts.master')
@section('page_title', 'Résultats')

@section('content')

<!-- Header -->
@include('results.partials.header')

<div class="text-center mtl mbl">
    {!! HTML::image('images/icons/settings.svg') !!}
    <h5>Log</h5>
    <hr/>
</div>

<div class="results-log">
    @if($log)
    <pre><code>{{ $log }}</code></pre>
    @else
    <p>Aucune information à afficher !</p>
    @endif
</div>
@stop
