<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
class CategoryController extends AbstractController
{
    protected $serializerInterface,$categoryRepository,$entityManager;
    public function __construct(SerializerInterface $serializerInterface,CategoryRepository $categoryRepository,EntityManagerInterface $entityManager) {
        $this->serializerInterface = $serializerInterface;
        $this->categoryRepository = $categoryRepository;
        $this->entityManager = $entityManager;
    }
    #[Route('/category', name: 'app_api_category', methods: ['GET'])]
    public function index()
    {
        $catgories = $this->categoryRepository->findAll();
        return $this->toJson($catgories);
    }
    #[Route('/category/{id}', name: 'app_api_category_show')]
    public function show($id)
    {
        $data['success'] = false;
        $category = $this->categoryRepository->find($id);
        if ($category) {
            $data['success'] = true;
            $data['category'] = $category;
        }
        return $this->toJson($data);
    }

    #[Route('/category', name: 'app_api_category_store', methods: ['POST'])]
    function store(Request $request)  {
        $category = json_decode($request->getContent(), true);
        // $form = $this->createForm(CategoryType::class, $category);
        // $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $this->entityManager->persist($category);
        //     $this->entityManager->flush();
        // }
    }

    function toJson($data) {
        $contentData = $this->serializerInterface->serialize($data,'json',["groups" => ['category_list']]);;
        return JsonResponse::fromJsonString($contentData);
    }
}
