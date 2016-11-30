<?php
/**
 * Created by PhpStorm.
 * User: narek
 * Date: 11/23/16
 * Time: 10:15 AM
 */

namespace Rentintersimrepo\users;

use App\User;



class UserManager
{
    public function getMyNetwork($id){
        $users = User::get()->toArray();
       $network = $this->buildTree($users, $id);
        $flat = $this->flatten($network);
        return $flat;
//        return $network;
    }


    function buildTree($elements, $parentId = 0)
    {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['supervisor_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['child'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    function flatten($element)
    {
        $flatArray = array();
        if (count($element) == 1 && !array_key_exists('child', $element) && !is_array($element)) {
            $flatArray[] = $element;
        }
            foreach ($element as $key => $node) {
//            if (is_array($node))
                if (array_key_exists('child', $node)) {
                    $flatArray =  $this->flatten($node['child']);
                    unset($node['child']);
                    $flatArray[] = $node;
//                    if (count($flat)>1)
//                    $flatArray[] = $flat;

                } else {
                    $flatArray[] = $node;
                }
            }


        return $flatArray;
    }

    function typeValidator($level){
        if($level == 'Super admin')
            return ['Distributor', 'Dealer', 'Subdealer'];
        elseif ($level == 'Distributor')
            return ['Dealer', 'Subdealer'];
        elseif ($level == 'Dealer')
            return ['Subdealer'];
        else return array();

    }

    function UserCreation($newUser, $user){
        if (in_array($newUser['level'], $this->typeValidator($user->level))){
            if ($newUser['type'] == 'admin')
                return true;
        }
        elseif ($newUser['type'] != 'admin' && $newUser['level'] == $user->level)
            return true;

        return false;
    }

}