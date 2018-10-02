@if(
    $options['actions']['detail'] ||
    $options['actions']['update'] ||
    $options['actions']['destroy']
)
    <td class="action text-center">
        <div class="btn-group" role="group">
            @include('chiron::components.buttons.detail')
            @include('chiron::components.buttons.update')
            @include('chiron::components.buttons.destroy')
        </div>
        @include('chiron::components.buttons.destroy-form')
    </td>
@endif