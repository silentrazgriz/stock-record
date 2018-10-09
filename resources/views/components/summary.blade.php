@foreach($user['user_accounts'] as $account)
<div class="card">
    <div class="card-header">
        {{ $account['name'] }}
    </div>
    <div class="card-body">
        @include('components.stock')
        @include('components.settlement')
    </div>
</div>
@endforeach