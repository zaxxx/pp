<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="category", indexes={@ORM\Index(name="pp_api_id_index", columns={"pp_api_id"})})
 */
class Category
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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     */
    private $parent;

    /**
     * @var Category[]|Collection
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    private $children;

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
     * @ORM\Column(type="string")
     */
    private $link;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @var int
     * @ORM\Column(type="integer", name="shops_count")
     */
    private $shopsCount;

    /**
     * @var Shop[]|Collection
     * @ORM\OneToMany(targetEntity="Shop", mappedBy="category")
     */
    private $shops;

    public function __construct()
    {
        $this->shops = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

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

    public function getParent(): ?Category
    {
        return $this->parent;
    }

    public function setParent(?Category $parent): void
    {
        $this->parent = $parent;
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

    /**
     * @return Collection|Category[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return Collection|Shop[]
     */
    public function getShops()
    {
        return $this->shops;
    }
}
