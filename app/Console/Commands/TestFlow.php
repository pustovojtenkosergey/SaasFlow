<?php

namespace App\Console\Commands;

use App\Infrastructure\Services\InternalSaas\InternalSaasCreatePackageService;
use App\Models\Package;
use App\Models\PackageGroup;
use Illuminate\Console\Command;

class TestFlow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'first Test flow command';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        /** @var PackageGroup $group */
//        $group = PackageGroup::find(1);

        /** @var Package $package */
        $package = Package::find(4);

        dd($package->packageMainGroup()?->toArray());
    }
}
