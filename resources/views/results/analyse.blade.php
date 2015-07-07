@extends('layouts.master')
@section('page_title', 'Résultats')

@section('content')

<!-- Header -->
@include('results.partials.header')

<div class="text-center mtl mbl">
    {!! HTML::image('images/icons/fit.svg') !!}
    <h5>Analyse</h5>
    <hr/>
</div>
<div class="mtl mbl well">
    <button class="btn btn-default btn-excel-download" data-excel-download-target-id='analyse' data-excel-download-title='Analyse des reponses'><span class="fui-document"></span> &nbsp;Télécharger au format excel</button>
</div>

<div class="results-analyse">
    <div class="table-responsive">
        <table id="analyse" class="table table-bordered first-col-left">
            <thead>
                <tr class='header'>
                    <th>Question</th>
                    <th>Nom</th>
                    <th>nb</th>
                    <th>%</th>
                </tr>
            </thead>
            @foreach($groupped as $field => $answers)
            <thead>
                <tr class='question'>
                    <th>{{ $questionTranslator->getTitle($field) }}</th>
                    <th class='fieldName'><span class='label label-default'>{{ $field }}</span></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($answers as $reply => $numberOfOccurences)
                <tr class='answers'>
                    <td class='text'>
                        {{ $questionTranslator->getField($field, $reply, '') }}
                    </td>
                    <td class='fieldName'>
                        <span class='label label-default'>{{ str_limit($reply, 60) }}</span>
                    </td>

                    <td>{{ $numberOfOccurences }}</td>
                    <td>{{ number_format($numberOfOccurences * 100 / $nbAnswer, 1, ',', ' ') }}%</td>
                </tr>
                @endforeach
            </tbody>
            @endforeach
        </table>
    </div>
</div>


@stop
