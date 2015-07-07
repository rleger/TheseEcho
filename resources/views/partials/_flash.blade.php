@if(Session::has('flash_notification') and count(Session::get('flash_notification')) > 0)
<div class="alert alert-info">
    <button class="close fui-cross" data-dismiss="alert"></button>
    <p>{{ Session::get('flash_notification') }}</p>
    {{ Session::forget('flash_notification') }}
</div>
@endif
