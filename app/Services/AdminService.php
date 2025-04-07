<?php
namespace App\Services;

use App\Repositories\AdminRepository;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class AdminService extends UserService
{
    protected $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository, UserRepositoryInterface $userRepository)
    {
        parent::__construct($userRepository);
        $this->adminRepository = $adminRepository;
    }

        public function fetchUsers(array $params)
        {
            $perPage = $params['per_page'] ?? 15;
            return $this->adminRepository->fetchUsers($params, $perPage);
        }



    public function approveUser($id)
    {
        return $this->adminRepository->approveUser($id);
    }

    public function suspendUser($id)
    {
        return $this->adminRepository->suspendUser($id);
    }

    // Product Management
    public function approveProduct($id)
    {
        return $this->adminRepository->approveProduct($id);
    }

    public function suspendProduct($id)
    {
        return $this->adminRepository->suspendProduct($id);
    }

    // Article Management
    public function approveArticle($id)
    {
        return $this->adminRepository->approveArticle($id);
    }

    public function suspendArticle($id)
    {
        return $this->adminRepository->suspendArticle($id);
    }

    // Get statistics
    public function getStatistics()
    {
        return $this->adminRepository->getStatistics();
    }
}

