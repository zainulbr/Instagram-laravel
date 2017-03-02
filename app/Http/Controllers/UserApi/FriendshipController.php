<?php


namespace App\Http\Controllers\UserApi;
use App\Repositories\UserApi\FriendshipRepository;

class FriendshipController extends BaseController {

    private $repository;

    public function __construct(FriendshipRepository $fr) {
        $this->repository = $fr;
    }

    public function follow() {
        return $this->respond($this->repository->follow());
    }

    public function unfollow() {
        return $this->respond($this->repository->unfollow());
    }

}