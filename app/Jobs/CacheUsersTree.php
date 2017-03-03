<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Rentintersimrepo\users\UserManager;
use App\User;

class CacheUsersTree implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $userManager;

    /**
     * Create a new job instance.
     *
     * @param UserManager $userManager
     *
     * @return void
     */
    public function __construct(UserManager $userManager)
    {
        //
        $this->userManager = $userManager;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $users = User::all();
        foreach ($users as $user){
            $json = json_encode($this->userManager->subNetID($this->userManager->getMyFlatNetwork($user->id), $user->id));
            $user->network = $json;
            $user->save();
        }
    }
}
