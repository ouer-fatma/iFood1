<?php

namespace App\Entity;

use App\Repository\PackLineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PackLineRepository::class)
 */
class PackLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Plate::class, inversedBy="packLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Plate;

    /**
     * @ORM\ManyToOne(targetEntity=Pack::class, inversedBy="packLines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pack;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPlate(): ?Plate
    {
        return $this->Plate;
    }

    public function setPlate(?Plate $Plate): self
    {
        $this->Plate = $Plate;

        return $this;
    }

    public function getPack(): ?Pack
    {
        return $this->pack;
    }

    public function setPack(?Pack $pack): self
    {
        $this->pack = $pack;

        return $this;
    }
    public function __toString(){
        return (string) $this->getId();
    }
}
