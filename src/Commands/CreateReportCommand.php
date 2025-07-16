<?php
namespace Thunderkiss52\LaravelDelayedReport\Commands;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Thunderkiss52\LaravelDelayedReport\Models\Report;
use Thunderkiss52\LaravelDelayedReport\Jobs\CreateReport;

class CreateReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Delayed reports';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $items = Report::where('completed', 0)->whereDate('execute_at', '<=', Carbon::now())->get();
        $this->withProgressBar($items, function (Report $item) {
            CreateReport::dispatch($item);
            $item->completed = null;
            $item->save();// ->execute();
        });
    }
}
