<?php
declare(strict_types=1);


namespace App\Http\Controllers;


use App\Component\Value\DateParser;
use App\Data\Summary\SummaryRepository;
use App\Data\User\UserRepository;
use App\Services\SettlementService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var SummaryRepository
     */
    private $summaryRepository;

    /**
     * @var SettlementService
     */
    private $settlementService;

    /**
     * DashboardController constructor.
     * @param UserRepository $userRepository
     * @param SummaryRepository $summaryRepository
     * @param SettlementService $settlementService
     */
    public function __construct(
        UserRepository $userRepository,
        SummaryRepository $summaryRepository,
        SettlementService $settlementService
    ) {
        $this->userRepository = $userRepository;
        $this->summaryRepository = $summaryRepository;
        $this->settlementService = $settlementService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if(Auth::guest()) {
            return redirect('login');
        }

        $startDate = DateParser::now();
        $endDate = $this->settlementService->getSettlementDate($startDate);

        $user = $this->userRepository->findById(
                Auth::user()->id,
                [
                    'userAccounts.summaries.quote',
                    'userAccounts.brokerAccount',
                    'userAccounts.settlements' => function ($query) use ($startDate, $endDate) {
                        $query->where([
                            ['settled_at', '>=', $startDate],
                            ['settled_at', '<=', $endDate]
                        ])
                        ->orderBy('settled_at', 'asc');
                    }
                ]
            )
            ->toArray();

        $user = $this->parseSettlement($user, $startDate);

        return view('dashboard', [
            'user' => $user
        ]);
    }

    /**
     * @param array $user
     * @param string $startDate
     * @return array
     */
    private function parseSettlement(array $user, string $startDate): array
    {
        foreach ($user['user_accounts'] as &$userAccount) {
            $settlements = $userAccount['settlements'];
            $result = $this->settlementService->getRecentSettlementDates($startDate);
            $total = $userAccount['balance'];
            foreach ($settlements as &$settlement) {
                $key = Carbon::parse($settlement['settled_at'])->toDateString();

                $result[$key]['income'] += $settlement['sell_amount'];
                $result[$key]['outcome'] += $settlement['buy_amount'];
                $result[$key]['net'] += $settlement['net_amount'];
            }
            foreach ($result as &$item) {
                $total += $item['margin'] + $item['income'] - $item['outcome'];
                $item['total'] = $total;
                if ($item['total'] < 0) {
                    $item['margin'] = ceil($item['total'] * $userAccount['broker_account']['margin_interest'] / 100);
                }
            }

            $userAccount['settlements'] = $result;
        }

        return $user;
    }
}