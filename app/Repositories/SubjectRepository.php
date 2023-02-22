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
}
