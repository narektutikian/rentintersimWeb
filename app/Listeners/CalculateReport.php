<?php

namespace App\Listeners;

use App\Events\ReportEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Rentintersimrepo\report\ReportHelper;
use App\Models\Report;
use Illuminate\Support\Facades\Log;

class CalculateReport
{
    protected $reportHelper;

    /**
     * Create the event listener.
     * @param ReportHelper $reportHelper
     *
     */
    public function __construct(ReportHelper $reportHelper)
    {
        //
        $this->reportHelper = $reportHelper;
    }

    /**
     * Handle the event.
     *
     * @param  ReportEvent $event
     *
     */
    public function handle(ReportEvent $event)
    {
        //
        Log::info('Report Event Handled For Order #'. $event->order->id);
        $order = $event->order;
        $report = $order->report;
        if ($report == null){
            $report = $report = $this->reportHelper->calculateReport($order);
            $report->save();

        }
    }
}
