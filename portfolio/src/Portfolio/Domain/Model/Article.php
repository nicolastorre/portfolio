<?php
namespace Portfolio\Domain\Model;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Kernel\Entity;

/**
 * Class Article
 * @package Portfolio\Domain\Model
 */
class Article extends Entity {
	/**
	 * Article id.
	 *
	 * @var integer
	 */
	protected $id;

	/**
	 * Article title.
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * @var int
	 */
	protected $publishedDate;

	/**
	 * @var user
	 */
	protected $author;

	/**
	 * @var string
	 */
	protected $image;

	/**
	 * Article content.
	 *
	 * @var string
	 */
	protected $content;

	/**
	 * @var int
	 */
	protected $published;

	/**
	 * @param ClassMetadata $metadata
	 */
	static public function loadValidatorMetadata(ClassMetadata $metadata)
	{
		$metadata->addPropertyConstraint('title', new Assert\NotBlank());
		$metadata->addPropertyConstraint('content', new Assert\NotBlank());
		$metadata->addPropertyConstraint('published', new Assert\NotBlank());
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * @return int
	 */
	public function getPublishedDate()
	{
		return $this->publishedDate;
	}

	/**
	 * @param int $publishedDate
	 */
	public function setPublishedDate($publishedDate)
	{
		$this->publishedDate = $publishedDate;
	}

	/**
	 * @return user
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * @param user $author
	 */
	public function setAuthor($author)
	{
		$this->author = $author;
	}

	/**
	 * @return string
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * @param string $image
	 */
	public function setImage($image)
	{
		$this->image = $image;
	}

	/**
	 * @return int
	 */
	public function getPublished()
	{
		return $this->published;
	}

	/**
	 * @param int $published
	 */
	public function setPublished($published)
	{
		$this->published = $published;
	}

}