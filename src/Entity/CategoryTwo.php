<?php

namespace App\Entity;

use App\Repository\CategoryTwoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryTwoRepository::class)]
class CategoryTwo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'categoryTwos')]
    private ?CategoryOne $categoryOne = null;

    /**
     * @var Collection<int, CategoryThree>
     */
    #[ORM\ManyToMany(targetEntity: CategoryThree::class, mappedBy: 'categoryTwo')]
    private Collection $categoryThrees;

    public function __construct()
    {
        $this->categoryThrees = new ArrayCollection();
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

    public function getCategoryOne(): ?CategoryOne
    {
        return $this->categoryOne;
    }

    public function setCategoryOne(?CategoryOne $categoryOne): static
    {
        $this->categoryOne = $categoryOne;

        return $this;
    }

    /**
     * @return Collection<int, CategoryThree>
     */
    public function getCategoryThrees(): Collection
    {
        return $this->categoryThrees;
    }

    public function addCategoryThree(CategoryThree $categoryThree): static
    {
        if (!$this->categoryThrees->contains($categoryThree)) {
            $this->categoryThrees->add($categoryThree);
            $categoryThree->addCategoryTwo($this);
        }

        return $this;
    }

    public function removeCategoryThree(CategoryThree $categoryThree): static
    {
        if ($this->categoryThrees->removeElement($categoryThree)) {
            $categoryThree->removeCategoryTwo($this);
        }

        return $this;
    }
}
