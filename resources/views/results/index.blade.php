@extends('layouts.master')
@section('page_title', 'Résultats')

@section('content')

<!-- Header -->
@include('results.partials.header')

<div class="text-center mtl mbl">
  {!! HTML::image('images/icons/graph.svg') !!}
  <h5>Résultats</h5>
  <hr/>
</div>

<div class="col-md-10 col-md-offset-1">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Récapitulatif</h3>
    </div>
    <div class="table-responsive">
      <table class="table table-striped first-col-left">
        <thead>
          <tr>
            <th></th>
            <th>Nombre</th>
            <th>Pourcentage</th>
          </tr>
        </thead>
        <tr>
          <td>Nombre de réponses</td>
          <td>{{ $participants }}</td>
          <td>-</td>
        </tr>
        <tr>
          <td>Nombre de centres</td>
          <td>{{ $centres_participants->count() }}</td>
          <td>-</td>
        </tr>
        <tr>
          <td>Centres non participants</td>
          <td>{{ $centres_non_participants->count() }}</td>
          <td>-</td>
        </tr>
        <tr>
          <td>Pratique de l'échographie</td>
          <td>{{ $results->howMany('interet_echo', 'oui') }}</td>
          <td>{{ formatNumberTwoDigits($results->howMany('interet_echo', 'oui', 'percentage')) }}%</td>
        </tr>
      </table>
    </div>
  </div>

  @if($results->centres_non_participants()->count())
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Centres n'ayant pas participé <span class='badge pull-right'>{{ $centres_non_participants->count() }}</span></h3>
    </div>

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>id</th>
            <th>Nom</th>
            <th>E-mail</th>
          </tr>
        </thead>
        <tbody>
          @foreach($centres_non_participants as $center)
          <tr>
            <td>{{ $center->id }}</td>
            <td>{{ $center->name }}</td>
            <td>{!! link_to('mailto:' . $center->email, $center->email) !!}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif
</div>
@stop
