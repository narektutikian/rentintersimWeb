<?php

namespace App\Console\Commands;

use App\Mail\ActivationReport;
use Illuminate\Console\Command;
use App\Models\Activation;
use Mail;

class CheckActivations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:activations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks previous activations and makes new attempts';

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
        //
        $activations = Activation::where([['attempts', null], ['answer', '!=', 0]])->get();
        $errors = [];
        foreach ($activations as $item){
            if (env('APP_ENV') == 'local')
                $res = file_get_contents("http://176.35.171.143:8086/api/vfapi.php?key=7963ad6960b1088b94db2c32f2975e86&call=simswap&test=true&cli=".$item->phone_number."&sim=".$item->sim_number);
            else
            $res = file_get_contents("http://176.35.171.143:8086/api/vfapi.php?key=7963ad6960b1088b94db2c32f2975e86&call=simswap&cli=".$item->phone_number."&sim=".$item->sim_number);
//            echo "id=$item->id&cli=$item->phone_number&sim=$item->sim_number \n";
            if ($res != 0){
                $errors[] = $item->id;
            }
            $item->attempts = 1;
            $item->answer = $res;
            $item->save();
        }
        if (!empty($errors)){
//            dd($errors);
            $address = 'service@syc.co.il';
            if (env('APP_ENV') == 'local')
                $address = 'narek@horizondvp.com';
            Mail::to($address, 'SimRent')
                ->queue(new ActivationReport($errors));
        }
    }
}
