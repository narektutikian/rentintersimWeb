<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;
use Rentintersimrepo\orders\CreateHelper;
use App\Jobs\ActivateOrder;

class StartActivation extends Command
{
    /**
     * Order helper property.
     *
     * @var CreateHelper
     */
    protected $orderHelper;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:activations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Takes all orders to activate them';

    /**
     * Create a new command instance.
     * @param CreateHelper $orderHelper
     * @return void
     */
    public function __construct(CreateHelper $orderHelper)
    {
        parent::__construct();
        $this->orderHelper = $orderHelper;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $now = Carbon::now();
        $orders = Order::withoutGlobalScopes()->where('status', 'pending')->where('from', '<', $now->timestamp+150)->get();
        if ($orders != null) {
            foreach ($orders as $order) {
//                TODO make queue for activating orders
                $order->status = 'activating';
                $order->save();
                dispatch(new ActivateOrder($this->orderHelper, $order));
            }
        }

    }
}
