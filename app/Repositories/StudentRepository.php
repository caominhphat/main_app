<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository extends ModelRepository
{

    public function getModel()
    {
        return Student::class;
    }

    public function getRules()
    {
       return [
           'add' => [
               'name' => 'required|max:255',
               'birth_day' => 'required',
           ],
           'edit' => [
               'name' => 'required|max:255',
               'birth_day' => 'required',
           ]
       ];
    }
}
