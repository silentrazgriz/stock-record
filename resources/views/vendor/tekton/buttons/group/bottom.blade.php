@if(
    $button['enabled'] &&
    $button['placement']['vertical'] == 'bottom' ||
    $button['placement']['vertical'] == 'both'
)
    @include('tekton::buttons.' . $button['placement']['horizontal'])
@endif