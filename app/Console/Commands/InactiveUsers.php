<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Trainee;
use Carbon\Carbon;
use App\Notifications\MailNotifier;

class InactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify : inactive users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and Notify incative users for 30 days';

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
     * @return mixed
     */
    public function handle()
    {
        $traniees =  Trinee::all();
        $time_now = Carbon::now();
        foreach ($traniees as $trainee) {
            $last_login = $trainee->last_login;
            $days = $last_login->diffInDays($time_now);
            // $time_difference = $time_now - $last_login;
            // $time_in_days = $time_difference /(24*60*60);
            if ($days >30) {
                $trainee->notify(new MailNotifier());
            }
        }
    }
}
