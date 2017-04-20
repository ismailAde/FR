<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Friend;

use App\Request as Requests;

class PagesController extends Controller
{
    public function hello(){
		$friend = Friend::createFriend(1, 19);
    	return $friend;
    }

    /**
    *
    *
    *
    */
    public function createUser(Request $request){
    	User::createUser($request->name, $request->email);
    	return redirect(route('index_path'));
    }

    /**
    *
    *
    *
    */
    public function selectUser(){
    	
    }


    /**
    *
    *
    *
    */
    public function listUsers(){
    	
    }


    /**
    *
    *
    *
    */
    public function removeFriend(){
    	
    }



    /**
    *
    *
    *
    */
    public function listNonFriends(){
    	
    }


    /**
    * Creates new request
    * @param int user_id reciver_id
    */
    public function createRequest(int $user_id, int $reciever_id){
    	$request = Requests::createRequest($user_id, $reciever_id);
    	return redirect(Route('user_path', [$user_id]));
    }


    /**
    * Accepts user request
    * @param int user_id, request_id
    * @return redirect
    */
    public function acceptRequest(int $user_id, int $sender_id){
    	$request_id = Requests::getRequestId($user_id, $sender_id);
    	$request = Requests::acceptRequest($request_id);

    	// Create new Friend Entry after request update success 
    	$friend = Friend::createFriend($user_id, $sender_id);
    	return redirect(Route('user_path', [$user_id]));   	
    }



    /**
    * Decline Friend Request
    * @param int request_id
    */
    public function declineRequest(int $user_id, int $sender_id){
    	$request_id = Requests::getRequestId($user_id, $sender_id);
    	$request = Requests::declineRequest($request_id);
    	return redirect(Route('user_path', [$user_id]));
    }


    /**
    *
    *
    *
    */
    public function listRequests(){
    	

	}

    /**
    * calls delete Friend
    * @param int User_id, friend_id
    */
    public function deleteFriend(int $user_id, int $friend_id){
    	$friend = Friend::deleteFriend($user_id, $friend_id);
    	return redirect(Route('user_path', [$user_id]));
    }


    /**
    *
    *
    *
    */
    public function index(){
    	$users = User::selectUsers();
    	return view('index', compact('users'));
    }


    /**
    *
    *
    *
    */
    public function user(int $user_id){
    	// Get all friends
    	$friends = Friend::selectFriendsById($user_id);
    	foreach ($friends as $friend) { // Get each friend ID and store in friend
    		$friend->friend = ($user_id != $friend->user_1)? $friend->user_1: $friend->user_2;
    	}

    	// Get Non-Friends
    	$nonFriends = User::selectUsers();
    	foreach ($nonFriends as $nonFriend) {
			if(($nonFriend->id == $user_id)|| (Requests::hasRequest($nonFriend->id, $user_id) == 'true') || (Friend::areFriends($nonFriend->id, $user_id) == 'true')){
    			$nonFriend->id = 0;
			}
    	}

    	$requests = Requests::getUserRequestsSender($user_id);
    	$user = User::selectUserById($user_id);
    	$allUsers = User::selectUsers();
    	return view('user', compact('user', 'requests', 'friends', 'nonFriends', 'allUsers'));
    }


}
