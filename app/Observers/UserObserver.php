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


class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
        dispatch(new CacheUsersTree(new UserManager()));
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        //
        dispatch(new CacheUsersTree(new UserManager()));
    }
}