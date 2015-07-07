@extends('layouts.master')
@section('page_title', 'Résultats')

@section('content')

<!-- Header -->
@include('results.partials.header')

<div class="text-center mtl mbl">
    {!! HTML::image('images/icons/map.svg') !!}
    <h5>Liste des réponses</h5>
    <hr/>
</div>

@if($nbAnswer === 0)
    <p>Aucune réponse au questionnaire pour l'instant !</p>
@else

<div class="results listAll">
    <div class="table-responsive">
        <table id="allAnswers" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                @foreach($groupped as $header => $data)
                <th class='{{ $header }}'>{{ ucfirst($header) }}</th>
                @endforeach
            </tr>
            </thead>
        <tbody>
            @for($i = 0 ; $i < $nbAnswer ; $i++)
            <tr>
                @foreach($groupped as $header => $data)
                <td class='{{ $header }}'><small>{{ $data[$i] }}</small></td>
                @endforeach
            </tr>
            @endfor
        </tbody>
        </table>
    </div>
</div>

<div class="mtl mbl">
    <button class="btn btn-default btn-excel-download" data-excel-download-target-id='allAnswers' data-excel-download-title='Liste des reponses'><span class="fui-document"></span> &nbsp;Télécharger au format excel</button>
</div>
@endif
@stop
