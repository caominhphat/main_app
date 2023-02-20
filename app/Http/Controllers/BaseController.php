<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function index() {

        return $this->repository->index();
    }

    public function delete ($id) {
        return $this->repository->delete($id);
    }
}
