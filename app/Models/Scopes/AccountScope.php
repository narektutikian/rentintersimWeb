<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 4/27/17
 * Time: 4:24 PM
 */
namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use App\User;

class AccountScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $user = Auth::user();
        $ids = array();
        if ($user == null){
            $items = User::select('account_id')->distinct('account_id')->get();
            foreach ($items as $item){
                $ids[] = $item->account_id;
            }
        }
        else
        $ids[] = $user->account_id;

        $builder->whereIn('account_id', $ids);
    }
}