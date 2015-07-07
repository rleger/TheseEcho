<h1>Nouveau Log</h1>

<p>Voici le dernier log</p>
@if($logFileName)
{!! link_to_route('log.view', $logFileName, [ 'filename' => $logFileName ]) !!}
@endif
