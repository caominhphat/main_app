<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

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
    abstract public function getRules();

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
        $cacheName = $this->_model->getTable().'_page_'.request('page', 1);

        $limit = $request['limit'] ?? 0;

        if (empty($limit) || !is_numeric($limit)) {
            $limit = config('app.list.limit');
        }
        $builder = $this->_model->where('delete_flag', config('constants.UNDELETED'));

        \cache()->remember($cacheName, 60*60, function() use ($limit, $builder) {
            return $builder->paginate($limit);
        });

        return Cache::get($cacheName);
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
        return $this->getUndeletedItems($request);
    }

    public function resources($id) {
        $result = [
            'validation' => $this->getRules(),
        ];
        if($id) {
            $item = $this->find($id);
            $result['object'] = $item;
        }
        return $result;
    }

    public function add ($request) {
        if(!empty($request)) {
            if(!empty($request['birth_day'])) {
                $request['birth_day'] =  $this->formatUTC($request['birth_day']);
            }
            return $this->isEditMode($request) ? $this->update($request['id'], $request) : $this->create($request);
        }
        return [
            'success' => false
        ];
    }

    protected function formatUTC ($sUtcTime) {
        return substr($sUtcTime, 0, 10);
    }

    protected function isEditMode($request){
        if(!empty($request['id'])) {
            return true;
        }
        return false;
    }
}
