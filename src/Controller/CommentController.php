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
    private $commentRepository;

    public function __construct(EntityManager $em)
    {
        /** @var EntityManager em */
        $this->em = $em;
        /** @var CommentRepository commentRepository */
        $this->commentRepository = $em->getRepository("Entity:Comment");
    }

    /**
     * Return all the comments recorded in the database.
     *
     * @return array|null
     */
    public function getAllComments()
    {
        return $this->commentRepository->findAll();
    }

    /**
     * @param $commentId
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteComment($commentId)
    {
        try {
            /** @var Comment $commentToDelete */
            $commentToDelete = $this->commentRepository->findOneBy(['id' => $commentId]);
            $this->em->remove($commentToDelete);
            $this->em->persist($commentToDelete);
            $this->em->flush();
            return ['status' => true, 'message' => 'done'];
        } catch (ORMException $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }


    /**
     * Add a comment to a news. Return the last comment id added to the database.
     *
     * @param string $content
     * @param int $newsId
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function addCommentForNews($content, News $news)
    {
        /** @var Comment $commentToAdd */
        $commentToAdd = new Comment();
        $commentToAdd->setContent($content);
        $commentToAdd->setNews($news);
        $commentToAdd->setCreatedAt(new \DateTime());
        $this->em->persist($commentToAdd);
        $this->em->flush();
        return $commentToAdd->getId();
    }
}