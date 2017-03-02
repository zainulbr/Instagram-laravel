<?php

namespace App\Http\Controllers\UserApi;

use App\Repositories\UserApi\CommentRepository;

class CommentController extends BaseController
{
    protected $repository;

    public function __construct(CommentRepository $repo)
    {
        $this->repository = $repo;
    }

    public function add()
    {
        return $this->respond($this->repository->add());
    }

    public function delete()
    {
        return $this->respond($this->repository->delete());
    }
}
