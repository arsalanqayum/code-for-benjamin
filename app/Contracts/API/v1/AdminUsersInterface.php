<?php


namespace App\Contracts\API\v1;


interface AdminUsersInterface
{
    public function getUsers();
    public function getUser($id);
    public function updateUser($data, $id);
    public function deleteUsers($id);
}
