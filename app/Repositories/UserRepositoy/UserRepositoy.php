<?php

namespace App\Repositories\UserRepositoy;

use App\Models\User;
use App\Repositories\Repository;

class UserRepositoy extends Repository
{
    /**
	 * @var string
	 * Return the model
	 */
	public function __construct()
	{
        $this->model = User::class;
    }  

	/**
     * fetch all user data from database
	 * 
	 * @return array
	 */	
    public function listApi(): array
    {
        return $this->model::all()->toArray();
    }    

}  