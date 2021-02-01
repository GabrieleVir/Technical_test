<?php
// src/Controller/NewsController.php

namespace src\Controller;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use src\Entity\News;
use src\Repository\NewsRepository;

class NewsController
{
    /**
     * @var
     */
    private $em;

    /**
     * @var NewsRepository
     */
    private $newsRepository;

    public function __construct(EntityManager $em)
    {
        /** @var EntityManager em */
        $this->em = $em;
        /** @var NewsRepository newsRepository */
        $this->newsRepository = $em->getRepository('Entity:News');
    }

    /**
     * Display on the command lines all the news with their comments.
     *
     * @return int
     */
    public function getNewsWithTheirComments()
    {
        /** @var NewsRepository $newsRepository */
        $newsRepository = $this->em->getRepository("Entity:News");
        /** @var \Doctrine\Common\Collections\ArrayCollection $findAllNews */
        $getAllNews = $newsRepository->findAll();
        /** @var \src\Entity\News $news */
        foreach ($getAllNews as $news) {
            echo("############ NEWS " . $news->getTitle() . " ############\n");
            echo($news->getBody() . "\n");
            /** @var \src\Entity\Comment $comment */
            foreach ($news->getComments() as $comment) {
                echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
            }
        }

        return 1;
    }

    /**
     * Get all the news recorded.
     *
     * @return array|null
     */
    public function getNews()
    {
        return $this->newsRepository->findAll();
    }

    /**
     * @param string $title
     * @param string $content
     * @return array|int
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addNews($title, $content)
    {
        try {
            /** @var News $newsToAdd */
            $newsToAdd = new News();
            $newsToAdd->setContent($content)
                        ->setTitle($title)
                        ->setCreatedAt(new \DateTime());
            $this->em->persist($newsToAdd);
            $this->em->flush();
            return ['status' => true, 'message' => 'done'];
        } catch (ORMException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * @param int $newsId
     * @return array
     */
    public function deleteNews($newsId)
    {
        try {
            /** @var News $newsToDelete */
            $newsToDelete = $this->newsRepository->findOneBy(['id' => $newsId]);
            $this->em->remove($newsToDelete);
            $this->em->flush();
            return ['status' => true, 'message' => 'done'];
        } catch (ORMException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

}