<?php

namespace App\Console\Commands;

use App\Helpers\DataHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Sponsorship\Repositories\SponsorshipRepository;

class SponsorshipCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sponsorship:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check sponsorship end date and update sponsorship status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("Sponsorship cron is working start");
        $this->_sponsorRepository     = new SponsorshipRepository;
        $sponsors = $this->_sponsorRepository->getAllByParams(['sponsorship_status' => 1]);
        foreach ($sponsors as $sponsor) {
            $currentDate = date('Y-m-d');
            $endDate = $sponsor->sponsorship_end_date;

            $timeCheck = strtotime($currentDate) <= strtotime($endDate);
            if ($timeCheck == true) {
                $this->_sponsorRepository->update(DataHelper::_normalizeParams(['sponsorship_status' => 0], false, true), $sponsor->sponsorship_id);
                Log::info('Sponsorship cron is working updated status');
            }
        }
        Log::info('Sponsorship cron is working finished');
    }
}
