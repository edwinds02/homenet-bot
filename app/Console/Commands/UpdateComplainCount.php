<?php

use Illuminate\Console\Command;
use App\Models\Complain;

class UpdateComplainCount extends Command
{
    protected $signature = 'complain:update';
    protected $description = 'Update total complain count at 10 PM and stop at 9 AM the next day';

    public function handle()
    {
        $currentTime = now();
        $startTime = $currentTime->copy()->setTime(22, 0, 0);
        $endTime = $currentTime->copy()->setTime(9, 0, 0)->addDay();

        if ($currentTime >= $startTime && $currentTime <= $endTime) {
            $complain = Complain::firstOrCreate([]);
            $complain->total_complain += 1;
            $complain->save();
            $this->info('Total complain incremented successfully.');
        } else {
            $this->info('It\'s not time to update the complain count.');
        }
    }
}
