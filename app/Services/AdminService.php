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


        public function approveUser(int $id): array
        {
            $result = $this->adminRepository->approveUser($id);
            return [
                'success' => $result,
                'message' => $result ? 'User approved successfully' : 'User not found or already approved'
            ];
        }

        public function suspendUser(int $id): array
        {
            $result = $this->adminRepository->suspendUser($id);
            return [
                'success' => $result,
                'message' => $result ? 'User suspended successfully' : 'User not found or already suspended'
            ];
        }

        public function approveProduct(int $id): array
        {
            $result = $this->adminRepository->approveProduct($id);
            return [
                'success' => $result,
                'message' => $result ? 'Product approved successfully' : 'Product not found or already approved'
            ];
        }

        public function suspendProduct(int $id): array
        {
            $result = $this->adminRepository->suspendProduct($id);
            return [
                'success' => $result,
                'message' => $result ? 'Product suspended successfully' : 'Product not found or already suspended'
            ];
        }

        public function approveArticle(int $id): array
        {
            $result = $this->adminRepository->approveArticle($id);
            return [
                'success' => $result,
                'message' => $result ? 'Article approved successfully' : 'Article not found or already approved'
            ];
        }

        public function suspendArticle(int $id): array
        {
            $result = $this->adminRepository->suspendArticle($id);
            return [
                'success' => $result,
                'message' => $result ? 'Article suspended successfully' : 'Article not found or already suspended'
            ];
        }

        public function getStatistics(): array
        {
            return [
                'success' => true,
                'data' => $this->adminRepository->getStatistics()
            ];
        }
}

