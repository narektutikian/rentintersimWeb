<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Activation;
use Mail;
use App\Mail\MailSimCheck;

class SimCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:sim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if the Api calls were sccessful.';

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
        $errors = array();
        $date = Carbon::now()->subHours(2)->format('Y-m-d H:i:s');
//        echo "Date - $date  \n";
        $activations = Activation::where('check_status', 'unchecked')->where('created_at', '<=', $date)->get();
        foreach ($activations as $item){
            $res = file_get_contents("http://176.35.171.143:8086/api/vfapi.php?key=7963ad6960b1088b94db2c32f2975e86&test=true&call=simcheck&cli=".$item->phone_number);
            if ($res == $item->sim_number)
                $item->check_status = 'OK';
            else {
                $item->check_status = $res;
                $errors[] = $item->id;
            }
            $item->save();
        }
        if (!empty($errors)){
//            dd($errors);
            $address = 'service@syc.co.il';
            if (env('APP_ENV') == 'local')
                $address = 'narek@horizondvp.com';
            Mail::to($address, 'SimRent')
                ->queue(new MailSimCheck($errors));
        }
    }
}
