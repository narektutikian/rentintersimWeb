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
use Rentintersimrepo\report\ReportHelper;


class ReportObserver
{
    protected $reportHelper;

    public function __construct(ReportHelper $reportHelper)
    {

        $this->reportHelper = $reportHelper;
    }
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function saved()
    {
        //
        $this->reportHelper->logReportChanges();
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleted()
    {
        //
        $this->reportHelper->logReportChanges();
    }
}