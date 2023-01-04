<?php

namespace App\Repositories\PostRepository;

use App\Models\Post;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;

class PostRepository extends Repository
{
    /**
	 * @var string
	 * Return the model
	 */
	public function __construct()
	{
        $this->model = Post::class;
    }  

	/**
     * fetch all post data from database
	 * 
	 * @return array
	 */	
    public function listApi(): array
    {
        return $this->model::orderBy('id', 'desc')->where('created_by',Auth::user()->id)->get()->toArray();
    }    

}  