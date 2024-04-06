<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Complain;

class GenerateComplaintData extends Command
{
    protected $signature = 'complain:generate';

    protected $description = 'Generate complain data automatically at 10 PM daily';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $complain = new Complain();
        $complain->total_complain = 1;
        $complain->starting_time = '22:00:00';
        $complain->ending_time = '09:00:00';
        $complain->save();

        $this->info('Complain data generated successfully.');
    }
}
