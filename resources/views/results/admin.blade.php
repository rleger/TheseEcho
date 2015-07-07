@extends('layouts.master')
@section('page_title', 'Résultats')

@section('content')

<!-- Header -->
@include('results.partials.header')

<div class="text-center mtl mbl">
    {!! HTML::image('images/icons/settings.svg') !!}
    <h5>Administation</h5>
    <hr/>
</div>

<!-- Tab list -->
<ul class="nav nav-tabs nav-append-content">
    <li class="active"><a href="#appLogs" data-toggle="tab">Application log</a></li>
    <li><a href="#systemLogs" data-toggle="tab">System logs</a></li>
</ul>

<!-- Tab content -->
<div class="tab-content">
    <!-- App Logs -->
    <div class="tab-pane active" id="appLogs">
        <div class="results-log">
            @if($applicationLog)
            <pre><code>{{ $applicationLog }}</code></pre>
            @else
            <p>Aucune information à afficher !</p>
            @endif
        </div>
    </div>

    <!-- System Logs -->
    <div class="tab-pane" id="systemLogs">
      <div class="system-log">

          @if($systemLogs)
          <ul class="list-group">
              @foreach($systemLogs as $log)
              <li class="list-group-item">
                  <span class='badge'>{{ $log['updated_at_for_humans'] }}</span>
                  <span class="fui-document"></span> &nbsp;
                  {!! link_to_route('log.view', ucfirst($log['filename']), ['log' => $log['filename']]) !!}
                  &nbsp;
                  <small>({{ $log['humanFilesize'] }})</small>
              </li>
              @endforeach
          </ul>
          @else
          <p>Aucune information à afficher !</p>
          @endif
      </div>
  </div>
</div>
@stop
