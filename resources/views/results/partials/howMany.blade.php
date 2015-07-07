<span class='pull-right'>
{{ $results->howMany($field, $value) }}
    <small>
        ({{ number_format($results->howMany($field, $value, 'percentage'), 1, ',', ' ') }}%)
    </small>
</span>