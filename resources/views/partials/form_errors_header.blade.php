@if($errors->any())
<div class="form-errors-header">
    {!! HTML::image('images/icons/patch1x.png') !!}
    @if($errors->count() === 1)
        <h4 class='heading'>Il y a une erreur !</h4>
    @else
        <h4 class='heading'>Il y a {{ $errors->count() }} erreurs !</h4>
    @endif
    <hr/>
    <ul class='content error-list'>
        @foreach($errors->keys() as $fieldName)
        <li class='error' data-error-target-field="{{ $fieldName }}">{{ $errors->first($fieldName) }}</li>
        @endforeach
    </ul>
</div>
@endif

