<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 11/30/16
 * Time: 7:10 PM
 */

namespace App\Http\ViewComposers;
use Illuminate\View\View;
use App\Models\Phone;
use App\Models\Sim;
use App\Models\Package;
use DB;


class NumberComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
//    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
//        $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $counts = ([
            'All' => Phone::all()->count(),
            'active' => Phone::filter('active')->count(),
            'pending' => Phone::filter('pending')->count(),
            'not in use' => Phone::filter('not in use')->count(),
        ]);

        $parking = DB::table('sims')->select('id', 'state', 'number')->where('state','=', 'parking')->whereNotIn('id', function($q){
            $q->select('initial_sim_id')->from('phones')->where('id', '>', 0);
        })->get();
//$parking = json_decode($parking, true);
//        dd($parking);

        $view->with('sims', $parking)
            ->with('packages', Package::select('id', 'name')->get()->toArray())
            ->with('counts', $counts)
            ->with('viewName', $view->getName());
    }
}