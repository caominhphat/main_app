<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller
{
    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request) {

        return $this->repository->index($request->toArray());
    }

    public function delete ($id) {
        return $this->repository->delete($id);
    }

    public function resources (Request $request) {
        return $this->repository->resources($request->toArray());
    }

    public function add (Request $request) {
        return $this->repository->add($request->toArray());
    }
}
