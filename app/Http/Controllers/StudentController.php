<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends BaseController
{
    public function __construct(StudentRepository $studentRepository){
        parent::__construct($studentRepository);
    }

    public function download($fileUrl) {
        $meta = null;
        if(Storage::disk("google")->exists($fileUrl)) {
            $meta = Storage::disk("google")
                ->get($fileUrl);
        }

        return $meta;
    }
}
