<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryOneRepository;

#[ORM\Entity(repositoryClass: CategoryOneRepository::class)]
class CategoryOne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT,nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, CategoryTwo>
     */
    #[ORM\OneToMany(targetEntity: CategoryTwo::class, mappedBy: 'categoryOne')]
    private Collection $categoryTwos;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'CategoryOneId')]
    private Collection $products;

    public function __construct()
    {
        $this->categoryTwos = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, CategoryTwo>
     */
    public function getCategoryTwos(): Collection
    {
        return $this->categoryTwos;
    }

    public function addCategoryTwo(CategoryTwo $categoryTwo): static
    {
        if (!$this->categoryTwos->contains($categoryTwo)) {
            $this->categoryTwos->add($categoryTwo);
            $categoryTwo->setCategoryOne($this);
        }

        return $this;
    }

    public function removeCategoryTwo(CategoryTwo $categoryTwo): static
    {
        if ($this->categoryTwos->removeElement($categoryTwo)) {
            // set the owning side to null (unless already changed)
            if ($categoryTwo->getCategoryOne() === $this) {
                $categoryTwo->setCategoryOne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->addCategoryOneId($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            $product->removeCategoryOneId($this);
        }

        return $this;
    }
}
