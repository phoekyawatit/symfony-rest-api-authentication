<?php

namespace App\Controller\Api;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Knp\DoctrineBehaviors\Contract\Entity\SoftDeletableInterface;
#[Route('/api', name: 'api_')]
class CustomerController extends AbstractController
{
    protected $customerRepository,$serializerInterface,$entityManagerInterface;
    public function __construct(CustomerRepository $customerRepository,SerializerInterface $serializerInterface,EntityManagerInterface $entityManagerInterface) {
        $this->customerRepository = $customerRepository;
        $this->serializerInterface = $serializerInterface;
        $this->entityManagerInterface = $entityManagerInterface;
    }
    // #[Route('/customer', name: 'api_customer', methods: ['GET'])]
    // public function index(): JsonResponse
    // {
    //     $customers = $this->customerRepository->findAll();
    //     dd($customers);
    //     $responseData = $this->serializerInterface->serialize($customers,'json',['groups' => ['customer_list']]);
    //     return JsonResponse::fromJsonString($responseData);
        
    // }

    // #[Route('/customer', name: 'api_customer_store', methods: ['POST'])]
    // public function store(Request $request): JsonResponse
    // {
    //     $customer = new Customer();
    //     $this->entityManagerInterface->persist($customer);
    //     $form = $this->createForm(CustomerType::class, $customer);
    //     $data = json_decode($request->getContent(),true);
    //     $form->submit($data);
    //     $this->entityManagerInterface->persist($customer);
    //     $this->entityManagerInterface->flush();
    //     $responseData = $this->serializerInterface->serialize($customer,'json',['groups' => ['customer_list']]);
    //     return JsonResponse::fromJsonString($responseData);
        
    // }
    // #[Route('/customer/{id}', name: 'api_customer_show', methods: ['GET'])]
    // public function show(Request $request,$id): JsonResponse
    // {
    //     $customer = $this->customerRepository->find($id);
    //     $responseData = $this->serializerInterface->serialize($customer,'json',['groups' => ['customer_list']]);
    //     return JsonResponse::fromJsonString($responseData);
        
    // }

    // #[Route('/customer/{id}', name: 'api_customer_delete', methods: ['DELETE'])]
    // public function delete(Customer $customer): JsonResponse
    // {
    //     $data["success"] = false;
    //     if ($customer) {
    //         $this->entityManagerInterface->persist($customer);
    //         $this->entityManagerInterface->flush();

    //         $this->entityManagerInterface->remove($customer);
    //         $this->entityManagerInterface->flush();

    //         // dd($customer->getDeletedBy());
    //         $data["success"] = true;
    //     }
    //     $responseData = $this->serializerInterface->serialize($data,'json');
    //     return JsonResponse::fromJsonString($responseData);
        
    // }
}
