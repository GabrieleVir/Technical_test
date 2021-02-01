<?php
// src/Entity/Comment.php
namespace src\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity(repositoryClass="src\Repository\CommentRepository")
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
     * @ORM\Column(type="text")
     */
    private $content;

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
     * Set content
     *
     * @param $content
     * @return Comment $this
     */
	public function setContent($content)
	{
		$this->content = $content;

		return $this;
	}

    /**
     * Get content
     *
     * @return string
     */
	public function getContent()
	{
		return $this->content;
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