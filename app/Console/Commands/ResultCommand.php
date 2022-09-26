<?php

namespace App\Console\Commands;

use App\Models\Result;
use Illuminate\Console\Command;

class ResultCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:result';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command create result';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $numbers = [];

        for ($i=0; $i < 6; $i++) {
            $number = rand(1, 60);

            if (!in_array($number, $numbers)) {
                $numbers[] = $number;
            }
        }

        $numbers = json_encode($numbers);

        Result::create(['numbers' => $numbers]);

        sleep(30);
    }
}
