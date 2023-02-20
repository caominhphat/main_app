<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\SubjectRepository;
use Illuminate\Http\Request;


class SubjectController extends BaseController
{

    protected SubjectRepository $subjectRepository;
    public function __construct(SubjectRepository $subjectRepository){
        parent::__construct($subjectRepository);
    }
}
