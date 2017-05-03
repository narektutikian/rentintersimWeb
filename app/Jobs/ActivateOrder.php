<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Rentintersimrepo\orders\CreateHelper;
use App\Models\Order;

class ActivateOrder implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $orderHelper;
    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CreateHelper $orderHelper, Order $order)
    {
        //
        $this->orderHelper = $orderHelper;
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->orderHelper->activate($this->order);

    }
}
