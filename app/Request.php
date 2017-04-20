<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Support\Facades\DB;

class Request extends Eloquent
{
    protected $fillable = [
    	'sender_id', 'reciever_id', 'status'
    ];


    /**
    * Inserts new entry into the requests table
    * @param int {sender_id, reciever_id}
    * @return
    */
    protected static function createRequest($sender_id, $reciever_id)
    {
    	$status = 'pending';
    	$request = DB::table('requests')->insert(['sender_id'=>$sender_id, 'reciever_id'=>$reciever_id, 'status'=>$status]);
    }


    /**
    * updates request status to accept in requests table
    * @param
    * @return
    */
    protected static function acceptRequest($request_id)
    {
    	$status = 'accepted';
    	$request = DB::table('requests')->where('id', '=', $request_id)->update(['status'=>$status]);
    	return $request;
    }


    /**
    * updates request status to declined in requests table
    * @param
    * @return
    */
    protected static function declineRequest($request_id)
    {
		$status = 'declined';
    	$request = DB::table('requests')->where('id', '=', $request_id)->update(['status'=>$status]);
    	return $request;
    }

    /**
    * get the id of a particular request
    * @param int reciever_id, sender_id
    * @return int request id
    */
    public static function getRequestId($reciever_id, $sender_id)
    {
    	$request_id = DB::table('requests')->where('reciever_id', '=', $reciever_id)->where('sender_id', '=', $sender_id)->value('id');
    	return $request_id;
    }

    /**
    * get all requests for user by user_id
    * @param int user_id
    * @return collection
    */
    public static function getUserRequests($user_id)
    {
    	$requests = DB::table('requests')->where('reciever_id', '=', $user_id)->get();
    	return $requests;
    }




    /**
    * get all request sender_id for user by user_id
    * @param int user_id
    * @return collection
    */
    public static function getUserRequestsSender($user_id)
    {
    	$status = 'pending';
    	$requests = DB::table('requests')->where('status', '=', $status)->where('reciever_id', '=', $user_id)->pluck('sender_id');
    	return $requests;
    }


    /**
    * Checks if users have existing friend request
    * @param int user_1, user_2
    * @return Boolean
    */
    public static function hasRequest($user_1, $user_2)
    {
    	$request = DB::table('requests')->where('sender_id', '=', $user_1)->where('reciever_id', '=', $user_2)->orWhere('sender_id', '=', $user_2)->where('reciever_id', '=', $user_1)->exists();
    	return $status = ($request === true)? 'true': 'false';
    }
}
