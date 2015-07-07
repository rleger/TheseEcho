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

@if(count($answersId) === 0)
    <p>Aucune réponse au questionnaire pour l'instant !</p>
@else

<div>
    <div class="table-responsive">
        <table id="explodedAnswers" class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                @foreach($groupped as $header => $data)
                <th class='{{ $header }}'>{{ ucfirst($header) }}</th>
                @endforeach
            </tr>
            </thead>
        <tbody>
            @foreach($answersId as $i => $id)
            <tr>
                @foreach($groupped as $header => $data)
                    @if(array_key_exists($id, $data))
                    <td class='{{ $header }}'><small>{{ $data[$id] }}</small></td>
                    @else
                    <td class='{{ $header }}'><small></small></td>
                    @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>

<div class="mtl mbl">
    <button class="btn btn-default btn-excel-download" data-excel-download-target-id='explodedAnswers' data-excel-download-title='Liste des reponses'><span class="fui-document"></span> &nbsp;Télécharger au format excel</button>
</div>
@endif
@stop
