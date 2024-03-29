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
        return $this->success($this->repository->delete($id));
    }

    public function resources ($id = null) {
        return $this->success($this->repository->resources($id));
    }

    public function add (Request $request) {
        return $this->success($this->repository->add($request));
    }

    protected function success($data = null)
    {
        if (isset($data['success']) && $data['success'] === false) {
            return $data;
        }
        $res = [
            'success' => true,
            'data' => $data
        ];
        return $res;
    }
}
