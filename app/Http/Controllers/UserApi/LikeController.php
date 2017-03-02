<?php

namespace App\Http\Controllers\UserApi;

use App\Repositories\UserApi\LikeRepository;

class LikeController extends BaseController
{
    protected $repository;

    public function __construct(LikeRepository $repo)
    {
        $this->repository = $repo;
    }
    
    public function like()
    {
        return $this->respond($this->repository->like());
    }

    public function unlike()
    {
        return $this->respond($this->repository->unlike());
    }
}
