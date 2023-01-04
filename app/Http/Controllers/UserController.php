<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepositoy\UserRepositoy;
use Exception;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

     /**
     * @param  UserRepository  $userRepository
     */
    public function __construct(
        private UserRepositoy $userRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return jsonResponse
     */
    public function index()
    {
        try{
            $user  = $this->userRepository->listApi();
            
            return response()->json([
                'success' => true,
                'status' => 200,
                'data' => $user,
                'message' =>'User data fetched successfully'
            ]);
        } catch (Exception $exception) {
            Log::error($exception);

            return response()->json([
                'success' => false,
                'status'=>403,    
                'message'=>'Error',
            ]);
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
     * @param  UserRequest  $request
     * @return jsonResponse
     */
    public function store(UserRequest $request)
    {
        try{
            $request['password'] =  Hash::make($request['password']);
            $store = $this->userRepository->create($request->all());

            return response()->json([
                'success' => true,   
                'status' =>200,   
                'data'=> $store,
                'message' =>'User Added succesfully',
            ]);
        } catch (Exception $exception) {
            Log::error($exception);

            return response()->json([
                'success' => false,
                'status'=>403,    
                'message'=>'Error',
            ]);
        }
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
     * @return jsonResponse
     */
    public function edit(int $id)
    {
        try{
            $edit = $this->userRepository->findById($id);
        
            return response()->json([
                'success' => true,
                'data'=>$edit,
                'message' =>'User fetched successfully'
            ]);
        } catch (Exception $exception) {
            Log::error($exception);

            return response()->json([
                'success' => false,
                'status'=>403,    
                'message'=>'Error',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  int  $id
     * @return jsonResponse
     */
    public function update(UserRequest $request, int $id)
    {
        try{  
            $user = $this->userRepository->update($id, $request->all());

            return response()->json([
                'success' => true,
                'status'=>200,  
                'data'=> $user,
                'message' =>'User Updated successfully'
            ]);
        } catch (Exception $exception) {
            Log::error($exception);

            return response()->json([
                'success' => false,
                'status'=>403,    
                'message'=>'Error',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return jsonResponse
     */
    public function destroy($id)
    {
        try{
        $delete = $this->userRepository->delete($id);
        
        return response()->json([
                'success' => true,
                'data'=>$delete,
                'message' =>'User Deleted',
            ]);
        } catch (Exception $exception) {
            Log::error($exception);

            return response()->json([
                'success' => false,
                'status'=>403,    
                'message'=>'Error',
            ]);
        }
    }
}
