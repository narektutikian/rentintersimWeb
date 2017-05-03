<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 3/3/17
 * Time: 4:37 PM
 */

namespace App\Observers;

use App\User;
use App\Jobs\CacheUsersTree;
use Rentintersimrepo\users\UserManager;
use Illuminate\Database\Eloquent\Model;
use Auth;


class BaseObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function creating(Model $model)
    {
        //
        $user = Auth::user();
        if ($user->level == 'root'){
            $next = ++User::select('account_id')->orderBy('account_id', 'desc')->first()->account_id;
            $model->account_id = $next;
        }
        else
        $model->account_id = $user->account_id;
//        $model->save();
    }

//    /**
//     * Listen to the User deleting event.
//     *
//     * @param  User  $user
//     * @return void
//     */
//    public function deleting(User $user)
//    {
//        //
//
//    }
}