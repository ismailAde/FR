<?php

namespace App;

//use Illuminate\Notifications\Notifiable;

//use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Support\Facades\DB;

class User extends Eloquent
{

    protected $fillable = [
        'name', 'email'
    ];


    /**
    * Insert new user entry into users table
    * @param string {name, email, created_at, updated_at}
    */
    public static function createUser($name, $email, $created_at=null, $updated_at=null)
    {
        $user = DB::table('users')->insert(['name'=>$name, 'email' => $email, 'created_at' => $created_at, 'updated_at' => $updated_at]);
    }

    /**
    * Select User by ID from users table
    * @param int (id)
    * @return collection
    */
    public static function selectUserById($id)
    {
        $user = DB::table('users')->whereId($id)->first();
        return $user;
    }

    /**
    * Selects all users from Users Table
    * @return collection
    */
    public static function selectUsers()
    {
        $users = DB::table('users')->get();
        return $users;
    }
}
