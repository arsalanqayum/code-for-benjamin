<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Contracts\API\v1\AdminUsersInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AdminUsersInterface $adminUsers)
    {
        if($request->wantsJson()){
            try {
                $users = $adminUsers->getUsers();
                if($users){
                    return response()->json(['error'=>false,'message'=>'Users','data'=>$users],200);
                }else{
                    return response()->json(['error'=>false,'message'=>'No records found.','data'=>[]],204);
                }
            }
            catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, AdminUsersInterface $adminUsers)
    {
        if($request->wantsJson()){
            try {
                $users = $adminUsers->getUser($id);
                if($users){
                    return response()->json(['error'=>false,'message'=>'User details','data'=>$users],200);
                }else{
                    return response()->json(['error'=>false,'message'=>'No records found.','data'=>[]],204);
                }
            }
            catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $updateUserRequest, $id, AdminUsersInterface $adminUsers)
    {
        if($updateUserRequest->wantsJson()){
            try {
                $user = $adminUsers->updateUser($updateUserRequest, $id);
                if($user){
                    return response()->json(['error'=>false,'message'=>'User updated successfully','data'=>$user],200);
                }else{
                    return response()->json(['error'=>false,'message'=>'No records found.','data'=>[]],204);
                }
            }
            catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $id, AdminUsersInterface $adminUsers)
    {
        if($request->wantsJson()){
            try {
                $users = $adminUsers->deleteUsers($id);
                if($users){
                    return response()->json(['error'=>false,'message'=>'User deleted successfully.','data'=>$users],202);
                }else{
                    return response()->json(['error'=>false,'message'=>'Something went wrong.','data'=>[]],204);
                }
            }
            catch (Exception $e) {
                return response()->json($e->getMessage(), 500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
}
