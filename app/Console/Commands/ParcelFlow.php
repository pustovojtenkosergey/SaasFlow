<?php

namespace App\Console\Commands;

use App\Infrastructure\Services\Saas\Api\SaasApiCreateParcelService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ParcelFlow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parcel:create {count} {country}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create parcels';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(private SaasApiCreateParcelService $apiCreateParcelService)
    {
        parent::__construct();
    }

    public function handle()
    {

        $count = $this->input->getArgument('count');
        $country = $this->input->getArgument('country');

        $this->info('Create ' . $count . ' parcels');

//        $this->output->progressStart($count);
        echo PHP_EOL;

        for ($i = 1; $i <= $count; $i++) {
            $this->info('Step ' . $i);
            $tracker = $this->apiCreateParcelService->createRandom($country);
            $this->info($tracker);
//            $this->output->progressAdvance();
            echo PHP_EOL;
        }

//        $this->output->progressFinish();
    }
}
