<?php


namespace App\Http\Controllers\UserApi;


use App\Repositories\UserApi\PasswordRepository;

class PasswordController extends BaseController
{
    private $repo;
    
    public function __construct(PasswordRepository $repo)
    {
        $this->repo = $repo;
    }

    public function change()
    {
        return $this->respond($this->repo->changePassword());
    }
}