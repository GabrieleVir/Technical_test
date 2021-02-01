<?php
// src/Controller/CommentController.php

namespace src\Controller;

use Doctrine\ORM\EntityManager;
use src\Entity\Comment;
use src\Entity\News;
use src\Repository\CommentRepository;

class CommentController
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var CommentRepository
     */
    private $commentRepo;

    public function __construct(EntityManager $em)
    {
        /** @var EntityManager em */
        $this->em = $em;
        /** @var CommentRepository commentRepo */
        $this->commentRepo = $em->getRepository("Entity:Comment");
    }

    /**
     * Return all the comments recorded in the database.
     *
     * @return array|null
     */
    public function getAllComments()
    {
        return $this->commentRepo->findAll();
    }

    /**
     * @param int $commentId
     * @return int
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteComment(Comment $commentToDelete)
    {
        $this->em->remove($commentToDelete);
        $this->em->persist($commentToDelete);
        $this->em->flush();
        return 1;
    }


    /**
     * Add a comment to a news. Return the last comment id added to the database.
     *
     * @param string $body
     * @param int $newsId
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function addCommentForNews($body, News $news)
    {
        /** @var \DateTime $presentDateAndTime */
        $presentDateAndTime = new \DateTime();
        /** @var Comment $commentToAdd */
        $commentToAdd = new Comment();
        $commentToAdd->setBody($body);
        $commentToAdd->setNews($news);
        $commentToAdd->setCreatedAt($presentDateAndTime);
        $this->em->persist($commentToAdd);
        $this->em->flush();
        return $commentToAdd->getId();
    }
}