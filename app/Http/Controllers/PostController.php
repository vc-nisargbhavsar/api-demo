<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Repositories\PostRepository\PostRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{

    /**
     * @param  PostRepositoy $PostRepository     
     * 
     */
    public function __construct(
        private PostRepository $PostRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        try{ 
            $data  = $this->PostRepository->listApi();
                
            return response()->json([
                'success' => true,
                'status'=>200,    
                'data'=> $data,
                'message'=>'All post data fethed',
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
     * @param  PostRequest $request
     * @return jsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        try{   
            $request['created_by'] = auth()->user()->id;
            $store = $this->PostRepository->create($request->all());
            
            return response()->json([
                'success' => true,
                'status'=>200,
                'data' =>$store,
                'message'=>'Data is stored sucessfully',
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
    public function edit(int $id): JsonResponse
    {
        try{
            $edit = $this->PostRepository->findById($id);

            return response()->json([
                'success' => true,
                'status'=>200,
                'data' =>$edit,
                'message'=>'Data for edit is fetched sucessfully',
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
     *  @param  PostRequest $request
     *  @param  int  $id
     *  @return jsonResponse
     */
    public function update(Request $request,int $id): JsonResponse
    {
        try{
            $post = $this->PostRepository->update($id,$request->all());

            return response()->json([
                'success' => true,
                'status'=> 200,
                'data' => $post,
                'message'=>'Data for edit is updated sucessfully',
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
    public function destroy(int $id): JsonResponse
    {
        try{
            $delete = $this->PostRepository->delete($id);
            
            return response()->json([
                'success' => true,
                'status' =>200,
                'data' =>$delete,
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
