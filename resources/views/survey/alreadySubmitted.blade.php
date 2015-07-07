@extends('layouts.master')
@section('page_title', 'Questionnaire')

@section('content')
<div class="col-md-8 col-md-offset-2">
<div class="well text-center mtl">
  <img src="images/icons/goal.svg" alt="Merci">
  <h3 class="mtl">Votre réponse est déjà enregistrée !</h3>

  <p>Si vous souhaitez recevoir les <strong>résultats de l'étude</strong> sur {!! $email !!},<br/> il vous suffit de cliquer sur le bouton ci-dessous.</p>

  <a href="{!! route('subscribe.answerer', 'results') !!}" class="btn btn-lg btn-primary mtl">
    <span class="fui-mail"></span>&nbsp;&nbsp;Recevoir les résultats de l'étude
  </a>

</div>
</div>
@stop
