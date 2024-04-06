<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ManageComplaintIncrement extends Command
{
    protected $signature = 'complain:manage';

    protected $description = 'Manage complain increment based on time range';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = now()->format('H:i:s');
        if ($now >= '22:00:00' || $now < '09:00:00') {
            DB::unprepared('
                CREATE TRIGGER increment_total_complaint AFTER INSERT ON complains
                FOR EACH ROW
                BEGIN
                    UPDATE threshold_complains SET total = total + 1;
                END
            ');
            $this->info('Complaint increment started.');
        } else {

            DB::unprepared('DROP TRIGGER IF EXISTS increment_total_complaint');
            $this->info('Complaint increment stopped.');
        }
    }
}
