<tbody>
@foreach($chiron['collections']['data'] as $collection)
    <tr>
        @foreach($chiron['fields'] as $field)
            @include('chiron::components.fields.' . $field['type'])
        @endforeach
        @include('chiron::components.rows.action')
    </tr>
@endforeach
</tbody>