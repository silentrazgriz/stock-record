<?php

namespace App\Console;

use App\Services\QuoteService;
use App\Services\SettlementService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package App\Console
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * @var QuoteService
     */
    private $quoteService;

    /**
     * @var SettlementService
     */
    private $settlementService;

    /**
     * Kernel constructor.
     * @param Application $app
     * @param Dispatcher $events
     * @param QuoteService $quoteService
     * @param SettlementService $settlementService
     */
    public function __construct(
        Application $app,
        Dispatcher $events,
        QuoteService $quoteService,
        SettlementService $settlementService
    ) {
        parent::__construct($app, $events);
        $this->quoteService = $quoteService;
        $this->settlementService = $settlementService;
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            $this->quoteService->updateQuote();
        })->dailyAt('18:00');

        $schedule->call(function() {
            $this->settlementService->calculateAllBalance();
        })->everyTenMinutes()->between('23:00', '03:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
