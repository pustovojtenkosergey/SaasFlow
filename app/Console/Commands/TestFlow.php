<?php

namespace App\Console\Commands;

use App\Infrastructure\Helpers\FlowStorage;
use App\Infrastructure\Services\Saas\Api\Auth\SaasApiAuthorizationService;
use App\Models\Parcel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class TestFlow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:flow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'first Test flow command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    const ZIP_INTERVALS = [
        ['JFK' => [005, 575]],
        ['LAX' => [576, 580]],
        ['JFK' => [581, 584]],
        ['LAX' => [585, 599]],
        ['JFK' => [600, 676]],
        ['LAX' => [677, 679]],
        ['JFK' => [680, 689]],
        ['JFK' => 690],
        ['LAX' => [691, 693]],
        ['JFK' => [700, 731]],
        ['LAX' => [732, 733]],
        ['JFK' => 734],
        ['LAX' => [735, 736]],
        ['JFK' => 737],
        ['LAX' => [738, 739]],
        ['JFK' => [740, 759]],
        ['LAX' => [760, 761]],
        ['JFK' => 762],
        ['LAX' => [763, 772]],
        ['JFK' => 773],
        ['LAX' => 774],
        ['JFK' => [775, 777]],
        ['LAX' => [778, 994]],
        ['JFK' => [995, 998]],
        ['LAX' => 999],
    ];

    /**
     * Execute the console command.
     */
    public function handle() {
        $res = FlowStorage::getAll();

        dd($res);
    }
}
