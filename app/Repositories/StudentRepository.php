<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository extends ModelRepository
{

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Student::class;
    }

}
