@foreach($user['user_accounts'] as $account)
<div class="card">
    <div class="card-header">
        {{ $account['name'] }}
    </div>
    <div class="card-body">
        <table class="table table-hover mb-2">
            @include('components.rows.title')
            @include('components.rows.content')
        </table>
    </div>
</div>
@endforeach