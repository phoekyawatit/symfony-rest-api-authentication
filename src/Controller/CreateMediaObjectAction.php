<?php
namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleTranslation;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class CreateMediaObjectAction extends AbstractController
{
    public function __invoke(Request $request,FileUploader $fileUploader,EntityManagerInterface $entityManager): Article
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }
        $article = new Article();
        $article->setImage($fileUploader->upload($uploadedFile));
        $article->setIsActive($request->get('is_active'));
        $translationsData = json_decode($request->get('translations'),true);
        foreach ($translationsData as $translationData) {
            $translation = new ArticleTranslation();
            $translation->setTitle($translationData['title']);
            $translation->setContent($translationData['content']);
            $translation->setLocale($translationData['locale']);
            $article->addTranslation($translation);
        }
        $entityManager->persist($article);
        $entityManager->flush();

        return $article;
    }
}