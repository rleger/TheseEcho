@section('page_title', 'Erreur')

@section('content')

<div class="col-md-8 col-md-offset-2">
    <div class="well text-center mal">

        {!! HTML::image('images/icons/help1x.png') !!}

        <h3 class="mtl">Oups !</h3>

        <p>{{ $message }}</p>

    </div>
</div>

@stop
