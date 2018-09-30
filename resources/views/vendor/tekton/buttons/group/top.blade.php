@if(
    $button['enabled'] &&
    $button['placement']['vertical'] == 'top' ||
    $button['placement']['vertical'] == 'both'
)
    @include('tekton::buttons.' . $button['placement']['horizontal'])
@endif