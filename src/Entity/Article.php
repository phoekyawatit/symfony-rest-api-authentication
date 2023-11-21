<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\BlameableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\LoggableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\SoftDeletableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Blameable\BlameableTrait;
use Knp\DoctrineBehaviors\Model\Loggable\LoggableTrait;
use Knp\DoctrineBehaviors\Model\SoftDeletable\SoftDeletableTrait;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use App\Controller\CreateMediaObjectAction;
use App\Validator\ContainsAlphanumeric;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiFilter(SearchFilter::class, properties: ['id','translations'], strategy: "exact")]
#[ApiFilter(OrderFilter::class, properties: ['id' => 'ASC'])] // sorting
#[ApiFilter(SearchFilter::class, properties: ['translations.title' => 'partial','translations.content' => 'partial'])] // add relation fitler
#[ApiResource]
// #[ApiResource(
//     operations: [
//         new Get(),
//         new GetCollection(),
//         new Post(
//             controller: CreateMediaObjectAction::class,
//             deserialize: false, 
//             openapi: new Model\Operation(
//                 requestBody: new Model\RequestBody(
//                     content: new \ArrayObject([
//                         'multipart/form-data' => [
//                             'schema' => [
//                                 'type' => 'object', 
//                                 'properties' => [
//                                     'file' => [
//                                         'type' => 'string', 
//                                         'format' => 'binary'
//                                     ],
//                                     'isActive' => [
//                                         'type' => 'boolean'
//                                     ],
//                                     'translations' => [
//                                         'type' => 'object'
//                                     ]
//                                 ]
//                             ]
//                         ]
//                     ])
//                 )
//             )
//                                     ),
//      new Put(),
//      new Patch(),
//      new Delete()
//     ]
// )]
class Article implements TimestampableInterface,BlameableInterface,SoftDeletableInterface,TranslatableInterface,LoggableInterface
{
    use TimestampableTrait,BlameableTrait,SoftDeletableTrait,TranslatableTrait,LoggableTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('article')]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?bool $is_active = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): static
    {
        $this->is_active = $is_active;

        return $this;
    }
    #[ApiFilter(SearchFilter::class, properties: ['title'])]
    public function getTitle(): string
    {
        return $this->translate()->getTitle();
    }
    
    public function getContent(): string
    {
        return $this->translate()->getContent();
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
    public function __toString()
    {
        return $this->image;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('is_active', new Assert\NotNull());
        // $metadata->addPropertyConstraint('is_active', new ContainsAlphanumeric(""));
    }
}
