<?php

namespace App\Console\Commands;

use App\Models\Complain;
use Illuminate\Console\Command;
use App\Models\Complaint;
use App\Models\ThresholdComplain;
use App\Models\ThresholdComplaint;
use Carbon\Carbon;

class CheckComplaintThreshold extends Command
{
    protected $signature = 'check:complaint-threshold';

    protected $description = 'Check if complaints exceed threshold and send webhook if so';

    public function handle()
    {
        $currentDateTime = now();
        $totalComplainsrange = Complain::where('starting_datetime', '<=', $currentDateTime)
            ->where('ending_datetime', '>=', $currentDateTime)
            ->first();
        $threshold = ThresholdComplain::first();

        if ($totalComplainsrange !== null && $threshold !== null) {
            if ($totalComplainsrange->total_complain > $threshold->total && $totalComplainsrange->total_complain > 0) {
                $client = new \GuzzleHttp\Client();
                $response = $client->post('https://4666-103-122-65-230.ngrok-free.app/api/webhook/pingtalk', [
                    'json' => [
                        'message' => 'Total complaints exceed threshold'
                    ]
                ]);
                if ($response->getStatusCode() == 200) {
                    $this->info('Webhook sent successfully');
                } else {
                    $this->error('Failed to send webhook');
                }
            } else {
                $this->info('Total complaints are within threshold or there are no complaints at the moment');
            }
        } else {
            $this->info('It is past 9:00 AM');
        }
    }
}
