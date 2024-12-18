<?php

namespace App\Jobs;

use App\Services\Admin\ReportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class generateGlobalReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $userId
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(ReportService $reportService): void
    {
        $data = $reportService->getDataGlobalReport();

        $check = $reportService->generateReport('admin.reports.global', $data, 'Global Report', $this->userId);

        // Сообщение(WebSocket)
//        if ($check) {
//            MessageEvent::dispatch($this->userId, 'Global Report generated. Check this in the "Reports" menu.');
//
//        } else {
//            MessageEvent::dispatch($this->userId, 'GError creating report. Please try again later.');
//        }
    }
}
