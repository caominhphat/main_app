<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends BaseController
{
    public function __construct(StudentRepository $studentRepository){
        parent::__construct($studentRepository);
    }
}
