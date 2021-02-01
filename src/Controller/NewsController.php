<?php
// src/Controller/NewsController.php

namespace src\Controller;

use Doctrine\ORM\EntityManager;
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
    public function displayAllNewsWithTheirComments()
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
    public function getAllNews()
    {
        return $this->newsRepository->findAll();
    }

    /**
     * Add a record in news table. Return the last id added to the database.
     *
     * @param string $title
     * @param string $body
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addNews($title, $body)
    {
        $presentDateAndTime = new \DateTime();
        $newsToAdd = new News();
        $newsToAdd->setBody($body);
        $newsToAdd->setTitle($title);
        $newsToAdd->setCreatedAt($presentDateAndTime);
        $this->em->persist($newsToAdd);
        $this->em->flush();
        return $newsToAdd->getId();
    }

    /**
     * Delete a news. The cascade will also delete all the comments linked to this news.
     *
     * @param News $newsToDelete
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteNews(News $newsToDelete)
    {
        $this->em->remove($newsToDelete);
        $this->em->flush();
        return 1;
    }

}