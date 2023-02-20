<?php

namespace App\Repositories;

abstract class ModelRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {

        return $this->_model->all();
    }

    public function getUndeletedItems($request)
    {
        $limit = $request['limit'] ?? 0;

        if (empty($limit) || !is_numeric($limit)) {
            $limit = config('app.list.limit');
        }
        $builder = $this->_model->where('delete_flag', config('constants.UNDELETED'));
        return $builder->paginate($limit);
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);

        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
            $result = $this->find($id);
            if ($result) {
                $result->update(['delete_flag'=> config('constants.DELETED')]);
                return true;
            }
            return false;
    }

    public function index($request)
    {
        return $this->getUndeletedItems($request)->toArray();
    }

}
