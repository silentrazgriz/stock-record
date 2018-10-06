<tbody>
@foreach($account['summaries'] as $summary)
    @php($buyValue = $summary['average_price'] * $summary['total_shares'])
    @php($currentValue = $summary['quote']['close'] * $summary['total_shares'])
    @php($buyFee = $buyValue * ($account['broker_account']['buy_commission'] / 100))
    @php($sellFee = $currentValue * ($account['broker_account']['sell_commission'] / 100))
    @php($fee = $buyFee + $sellFee)
    @php($gainLoss = $currentValue - ($buyValue + $fee))
    @php($gainLossPercent = ($gainLoss * 100) / $buyValue)
    <tr class="{{ $gainLoss <= 0 ? 'text-danger' : 'text-success' }} font-weight-bold">
        <td>{{ $summary['quote']['code'] }}</td>
        <td class="text-right">{{ number_format($summary['quote']['close']) }}</td>
        <td class="text-right">{{ number_format($summary['average_price']) }}</td>
        <td class="text-right">{{ number_format($summary['total_shares']) }}</td>
        <td class="text-right">{{ number_format($buyFee) }}</td>
        <td class="text-right">{{ number_format($sellFee) }}</td>
        <td class="text-right">{{ number_format($currentValue) }}</td>
        <td class="text-right">{{ number_format($gainLoss) }}</td>
        <td class="text-right">{{ number_format($gainLossPercent, 2) }} %</td>
    </tr>
@endforeach
</tbody>