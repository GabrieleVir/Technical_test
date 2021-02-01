<?php
// src/Entity/Comment.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $body;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @var News
     *
     * @ManyToOne(targetEntity="News")
     * @JoinColumn(name="news_id", referencedColumnName="id")
     */
    private $news;

    /**
     * Get Id
     *
     * @return int
     */
	public function getId()
	{
		return $this->id;
	}

    /**
     * Set body
     *
     * @param $body
     * @return Comment $this
     */
	public function setBody($body)
	{
		$this->body = $body;

		return $this;
	}

    /**
     * Get body
     *
     * @return string
     */
	public function getBody()
	{
		return $this->body;
	}

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     * @return Comment $this
     */
	public function setCreatedAt(DateTime $createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}

    /**
     * Get createdAt
     *
     * @return DateTime
     */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

    /**
     * Get the news linked to the comment
     *
     * @return News
     */
	public function getNews()
	{
		return $this->news;
	}

    /**
     * Set the news linked to the comment
     *
     * @param News $news
     * @return Comment $this
     */
	public function setNews(News $news)
	{
		$this->news = $news;

		return $this;
	}
}