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

}
