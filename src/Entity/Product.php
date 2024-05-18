<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
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
    private ?float $purchasePrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $sellingPrice = null;

    #[ORM\Column]
    private ?float $quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $principActif = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $expiryDate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, CategoryOne>
     */
    #[ORM\ManyToMany(targetEntity: CategoryOne::class, inversedBy: 'products')]
    private Collection $CategoryOneId;

    /**
     * @var Collection<int, Units>
     */
    #[ORM\ManyToMany(targetEntity: Units::class, inversedBy: 'products')]
    private Collection $unitId;

    /**
     * @var Collection<int, Suppliers>
     */
    #[ORM\ManyToMany(targetEntity: Suppliers::class, inversedBy: 'products')]
    private Collection $supplierId;

    /**
     * @var Collection<int, OrderItems>
     */
    #[ORM\OneToMany(targetEntity: OrderItems::class, mappedBy: 'product')]
    private Collection $orderItems;

    /**
     * @var Collection<int, StockMouvements>
     */
    #[ORM\OneToMany(targetEntity: StockMouvements::class, mappedBy: 'product')]
    private Collection $stockMouvements;

    public function __construct()
    {
        $this->CategoryOneId = new ArrayCollection();
        $this->unitId = new ArrayCollection();
        $this->supplierId = new ArrayCollection();
        $this->orderItems = new ArrayCollection();
        $this->stockMouvements = new ArrayCollection();
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

    public function getPurchasePrice(): ?float
    {
        return $this->purchasePrice;
    }

    public function setPurchasePrice(float $purchasePrice): static
    {
        $this->purchasePrice = $purchasePrice;

        return $this;
    }

    public function getSellingPrice(): ?float
    {
        return $this->sellingPrice;
    }

    public function setSellingPrice(?float $sellingPrice): static
    {
        $this->sellingPrice = $sellingPrice;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrincipActif(): ?string
    {
        return $this->principActif;
    }

    public function setPrincipActif(?string $principActif): static
    {
        $this->principActif = $principActif;

        return $this;
    }

    public function getExpiryDate(): ?\DateTimeInterface
    {
        return $this->expiryDate;
    }

    public function setExpiryDate(?\DateTimeInterface $expiryDate): static
    {
        $this->expiryDate = $expiryDate;

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
     * @return Collection<int, CategoryOne>
     */
    public function getCategoryOneId(): Collection
    {
        return $this->CategoryOneId;
    }

    public function addCategoryOneId(CategoryOne $categoryOneId): static
    {
        if (!$this->CategoryOneId->contains($categoryOneId)) {
            $this->CategoryOneId->add($categoryOneId);
        }

        return $this;
    }

    public function removeCategoryOneId(CategoryOne $categoryOneId): static
    {
        $this->CategoryOneId->removeElement($categoryOneId);

        return $this;
    }

    /**
     * @return Collection<int, Units>
     */
    public function getUnitId(): Collection
    {
        return $this->unitId;
    }

    public function addUnitId(Units $unitId): static
    {
        if (!$this->unitId->contains($unitId)) {
            $this->unitId->add($unitId);
        }

        return $this;
    }

    public function removeUnitId(Units $unitId): static
    {
        $this->unitId->removeElement($unitId);

        return $this;
    }

    /**
     * @return Collection<int, Suppliers>
     */
    public function getSupplierId(): Collection
    {
        return $this->supplierId;
    }

    public function addSupplierId(Suppliers $supplierId): static
    {
        if (!$this->supplierId->contains($supplierId)) {
            $this->supplierId->add($supplierId);
        }

        return $this;
    }

    public function removeSupplierId(Suppliers $supplierId): static
    {
        $this->supplierId->removeElement($supplierId);

        return $this;
    }

    /**
     * @return Collection<int, OrderItems>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItems $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setProduct($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItems $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getProduct() === $this) {
                $orderItem->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, StockMouvements>
     */
    public function getStockMouvements(): Collection
    {
        return $this->stockMouvements;
    }

    public function addStockMouvement(StockMouvements $stockMouvement): static
    {
        if (!$this->stockMouvements->contains($stockMouvement)) {
            $this->stockMouvements->add($stockMouvement);
            $stockMouvement->setProduct($this);
        }

        return $this;
    }

    public function removeStockMouvement(StockMouvements $stockMouvement): static
    {
        if ($this->stockMouvements->removeElement($stockMouvement)) {
            // set the owning side to null (unless already changed)
            if ($stockMouvement->getProduct() === $this) {
                $stockMouvement->setProduct(null);
            }
        }

        return $this;
    }
}
