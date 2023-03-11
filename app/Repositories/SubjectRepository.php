<?php

namespace App\Repositories;

use App\Models\Subject;

class SubjectRepository extends ModelRepository
{

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Subject::class;
    }

    public function getRules()
    {
        return [
            'add' => [
                'name' => 'required|max:255',
            ],
            'edit' => [
                'name' => 'required|max:255',
            ]
        ];
    }

    public function getAll()
    {
        $user = $this->_model;
//        dd($user->with('students')->get()->toArray());
        return $this->_model->all();
    }
}
