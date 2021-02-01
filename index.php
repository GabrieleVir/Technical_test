<?php
/**
 * This app will show all the news with their comments when runned and puts all the comments inside a variable.
 * To run it write "php index.php" on the command line.
 */
// /index.php
require_once("config/bootstrap.php");
use src\Controller\NewsController;
use src\Controller\CommentController;

$newsController = new NewsController($entityManager);
$commentController = new CommentController($entityManager);
$newsController->getNewsWithTheirComments();

/** @var \Doctrine\Common\Collections\ArrayCollection $getAllComments */
$getAllComments = $commentController->getAllComments();