<?php

namespace App\Entity;

use App\Repository\LivraisonSearchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivraisonSearchRepository::class)
 */
class LivraisonSearch
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
    private $idDelivery;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DeliveryGuy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDelivery(): ?int
    {
        return $this->idDelivery;
    }

    public function setIdDelivery(int $idDelivery): self
    {
        $this->idDelivery = $idDelivery;

        return $this;
    }

    public function getDeliveryGuy(): ?string
    {
        return $this->DeliveryGuy;
    }

    public function setDeliveryGuy(?string $DeliveryGuy): self
    {
        $this->DeliveryGuy = $DeliveryGuy;

        return $this;
    }
}
