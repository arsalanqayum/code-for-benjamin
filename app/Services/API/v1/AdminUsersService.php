<?php


namespace App\Services\API\v1;


use App\Contracts\API\v1\AdminUsersInterface;
use App\User;
use Illuminate\Support\Facades\DB;

class AdminUsersService implements AdminUsersInterface
{
    public function getUsers(){
        $users = User::withTrashed()->get();
        return $users ? $users : false;
    }

    public function getUser($id){
        $users = User::withTrashed()->where('id', $id)->first();
        return $users ? $users : false;
    }

    public function updateUser($data, $id){
        $user = DB::table('users')
            ->where('id', $id)
            ->update(
                [
                    'name' => $data['name'],
                    'nickname' => $data['nickname'],
                    'title' => $data['title'],
                    'date_of_birth' => $data['date_of_birth'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'country' => $data['country'],
                    'postal_or_zip_code' => $data['postal_or_zip_code'],
                    'timezone' => $data['timezone'],
                    'role' => $data['role'],
                    'receive_email_updates' => $data['receive_email_updates'],
                ]
            );
        return $user ? $user : false;
    }

    public function deleteUsers($id){
        $deleted = User::destroy($id);
        return $deleted ? $deleted : false;
    }
}
