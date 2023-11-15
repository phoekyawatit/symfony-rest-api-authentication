<?php
 
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DashboardController.php',
        ]);
    }
    #[Route('/users', name: 'app_users')]
    public function users(UserRepository $userRepository,SerializerInterface $serializerInterface)
    {
        // $this->getUser()
        $users = $userRepository->findAll();
        $contentData = $serializerInterface->serialize($users,'json');
        // dd($contentData);
        // return $serializerInterface->serialize($users, 'json');
        return JsonResponse::fromJsonString($contentData);
    }
}