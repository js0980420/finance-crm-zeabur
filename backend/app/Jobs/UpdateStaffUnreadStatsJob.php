<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
// use App\Services\FirebaseStaffStatsService;

class UpdateStaffUnreadStatsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $staffId;
    protected $updateAll;

    /**
     * Create a new job instance.
     *
     * @param int|null $staffId 特定員工 ID，null 表示更新所有員工
     * @param bool $updateAll 是否強制更新所有員工統計
     */
    public function __construct($staffId = null, $updateAll = false)
    {
        $this->staffId = $staffId;
        $this->updateAll = $updateAll;
        
        // 設定隊列優先級
        $this->onQueue('firebase-stats');
    }

    /**
     * Execute the job.
     * Firebase disabled for Zeabur deployment - this job does nothing
     */
    public function handle(): void
    {
        Log::info('Staff stats update job skipped (Firebase disabled)', [
            'staff_id' => $this->staffId,
            'update_all' => $this->updateAll
        ]);
        return;
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::channel('firebase')->error('Staff stats update job failed permanently', [
            'staff_id' => $this->staffId,
            'update_all' => $this->updateAll,
            'error' => $exception->getMessage(),
            'attempts' => $this->attempts()
        ]);
    }

    /**
     * Calculate the number of seconds to wait before retrying the job.
     */
    public function backoff(): array
    {
        // 重試間隔：30秒、2分鐘、5分鐘
        return [30, 120, 300];
    }

    /**
     * The maximum number of retries for this job.
     */
    public $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     */
    public $timeout = 300; // 5分鐘超時
}