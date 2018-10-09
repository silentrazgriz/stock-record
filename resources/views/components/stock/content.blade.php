<tbody>
@php
    $sumBuyValue = 0;
    $sumValue = 0;
    $sumGainLoss = 0;
    $sumGainLossPercent = 0;
@endphp
@foreach($account['summaries'] as $summary)
    @php
        $buyValue = $summary['average_price'] * $summary['total_shares'];
        $currentValue = $summary['quote']['close'] * $summary['total_shares'];
        $buyFee = $buyValue * ($account['broker_account']['buy_commission'] / 100);
        $sellFee = $currentValue * ($account['broker_account']['sell_commission'] / 100);
        $fee = $buyFee + $sellFee;
        $gainLoss = $currentValue - ($buyValue + $fee);
        $gainLossPercent = ($gainLoss * 100) / $buyValue;

        $sumBuyValue += $buyValue + $buyFee;
        $sumValue += $currentValue;
        $sumGainLoss = $sumValue - $sumBuyValue;
        $sumGainLossPercent = $gainLoss * 100 / $sumBuyValue;
    @endphp
    <tr class="{{ $gainLoss <= 0 ? 'text-danger' : 'text-success' }} font-weight-bold">
        <td>{{ $summary['quote']['code'] }}</td>
        <td class="text-right">{{ number_format($summary['quote']['close']) }}</td>
        <td class="text-right">{{ number_format($summary['average_price']) }}</td>
        <td class="text-right">{{ number_format($summary['total_shares']) }}</td>
        <td class="text-right">{{ number_format($buyFee) }}</td>
        <td class="text-right">{{ number_format($sellFee) }}</td>
        <td class="text-right">{{ number_format($buyValue) }}</td>
        <td class="text-right">{{ number_format($currentValue) }}</td>
        <td class="text-right">{{ number_format($gainLoss) }}</td>
        <td class="text-right">{{ number_format($gainLossPercent, 2) }} %</td>
    </tr>
@endforeach
    <tr class="{{ $sumGainLoss <= 0 ? 'text-danger' : 'text-success' }} font-weight-bold">
        <td colspan="6"></td>
        <td class="text-right">{{ number_format($sumBuyValue) }}</td>
        <td class="text-right">{{ number_format($sumValue) }}</td>
        <td class="text-right">{{ number_format($sumGainLoss) }}</td>
        <td class="text-right">{{ number_format($sumGainLossPercent, 2) }} %</td>
    </tr>
</tbody>