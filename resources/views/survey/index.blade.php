@extends('layouts.master')
@section('page_title', 'Questionnaire')

@section('content')
<p>Contenu</p>
<div class="col-md-8 col-md-offset-2">

    {!! Form::open() !!}
    <!-- Test form input -->
    <div id="frenchCities" class="form-group">
        {!! Form::label('Cities', 'Cities : ') !!}
        {!! Form::text('Cities', null, ['class' => 'form-control typeahead']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('test', 'Test de select') !!}
        {!! Form::select('test', ['1'=>'abc', '2'=>'def'], null, ["class" => "form-control selectpicker"])  !!}
    </div>

    <div class="form-group">
        {!! Form::label('test', 'Test de select') !!}

        {!! Form::checkbox('name', 'value') !!}

        {!! Form::radio('radio1', 'value') !!}
        {!! Form::radio('radio1', 'value') !!}

        <div class="checkbox">
          <label><input type="checkbox" value="">Option 1</label>
      </div>
      <div class="checkbox">
          <label><input type="checkbox" value="">Option 2</label>
      </div>
      <div class="checkbox disabled">
          <label><input type="checkbox" value="" disabled>Option 3</label>
      </div>

      <div class="radio">
          <label><input type="radio" name="optradio">Option 1</label>
      </div>
      <div class="radio">
          <label><input type="radio" name="optradio">Option 2</label>
      </div>
      <div class="radio disabled">
          <label><input type="radio" name="optradio" disabled>Option 3</label>
      </div>

  </div>
  {!! Form::close() !!}
</div>
@stop
