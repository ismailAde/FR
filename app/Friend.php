<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Support\Facades\DB;

class Friend extends Eloquent
{
    protected $fillable = [
    	'user_1', 'user_2'
    ];


    /**
    * Inserts friend into friends table
    * @param int {user_1, user_2}
    */
    public static function createFriend($user_1, $user_2, $created_at = null, $updated_at = null){
    	$friend = DB::table('friends')->insert(['user_1'=>$user_1, 'user_2'=>$user_2, 'created_at'=>$created_at, 'updated_at'=>$updated_at, 'friend'=> 0]);
    }


    /**
    * Selects friends by id from friends table
    * @param int user_id
    * @return collection (of all friend entries related to user_id)
    */
    public static function selectFriendsById($user_id)
    {
    	$friends = DB::table('friends')->where('User_1', $user_id)->orWhere('User_2', $user_id)->get();
    	return $friends;
    }

    /**
    * Delete friend from users table
    * @param int user_id, friend_id
    */
    public static function deleteFriend($user_id, $friend_id)
    {
    	$friend = DB::table('friends')->where('user_1', '=', $user_id)->where('user_2', '=', $friend_id)->orWhere('user_1', '=', $friend_id)->where('user_2', '=', $user_id)->delete();
    }

    /**
    * Checks if two people are friends by ID
    * @param int user_id, friend_id
    * @return boolean
    */
    public static function areFriends($user_id, $friend_id)
    {
    	$friend = DB::table('friends')->where('user_1', '=', $user_id)->where('user_2', '=', $friend_id)->orWhere('user_1', '=', $friend_id)->where('user_2', '=', $user_id)->exists();
		return $status = ($friend == true)? 'true': 'false';
    }
}
