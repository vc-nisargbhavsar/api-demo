<?php

namespace App\Repositories;

class Repository
{

    /**
     * Model::class
     */
    public $model;

    /**
     * Fetch all data from database
     * 
     * @return mixed
     */
    public function findAll(): mixed
    {
        return $this->model::all();
    }

    /**
     * Fetch data of specific id
     *
     * @param int $id 
     * @return mixed
     */
    public function findById(int $id): mixed
    {
        return $this->model::find($id);
    }

    /**
     * stored data in database
     *
     * @param array $data 
     * @return 
     */
    public function create(array $data)
    {
        return $this->model::create($data)->fresh();
    }

    /**
     * Update data 
     *
     * @param int $id
     * @param array $data 
     * @return 
     */
    public function update(int $id, array $data)
    {
        $update = $this->model::find($id);
        $update->fill($data);
        $update->save();

        return $update->fresh();
    }

    /**
     * Delete data 
     *
     * @param int $id
     * @return mixed
     */
    public function delete(int $id):mixed
    {
        return $this->model::find($id)->delete();
    }

}