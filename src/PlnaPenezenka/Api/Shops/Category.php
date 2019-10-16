<?php
declare(strict_types=1);

namespace PlnaPenezenka\Api\Shops;

class Category
{
    /** @var int */
    private $id;

    /** @var int|null */
    private $parentId;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $imageUrl;

    /** @var string */
    private $link;

    /** @var string */
    private $slug;

    /** @var int */
    private $shopsCount;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
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

    public function getShopsCount(): int
    {
        return $this->shopsCount;
    }

    public function setShopsCount(int $shopsCount): void
    {
        $this->shopsCount = $shopsCount;
    }
}
