<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="shop", indexes={@ORM\Index(name="pp_api_id_index", columns={"pp_api_id"})})
 */
class Shop
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer", name="pp_api_id")
     */
    private $ppApiId;

    /**
     * @var Category|null
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="shops")
     */
    private $category;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string", name="image_url")
     */
    private $imageUrl;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $link;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="is_favorite")
     */
    private $isFavorite;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $popularity;

    public function getId(): int
    {
        return $this->id;
    }

    public function getPpApiId(): int
    {
        return $this->ppApiId;
    }

    public function setPpApiId(int $ppApiId): void
    {
        $this->ppApiId = $ppApiId;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function isFavorite(): bool
    {
        return $this->isFavorite;
    }

    public function setIsFavorite(bool $isFavorite): void
    {
        $this->isFavorite = $isFavorite;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getPopularity(): float
    {
        return $this->popularity;
    }

    public function setPopularity(float $popularity): void
    {
        $this->popularity = $popularity;
    }
}
