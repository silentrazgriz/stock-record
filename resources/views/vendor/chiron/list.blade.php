@extends('base')

@section('content')
    @php($options = $chiron['options'])
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    {{ $chiron['title'] }}
                </div>
                <div class="card-body">
                    @include('chiron::components.header')
                    <table class="table table-hover mb-2">
                        @include('chiron::components.rows.title')
                        @include('chiron::components.rows.content')
                    </table>
                    @include('chiron::components.pagination')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.delete-item').each((index, item) => {
            item.addEventListener('click', (e) => {
                let target = item.dataset.target;
                $(target)[0].submit();
            });
        });
    </script>
@append