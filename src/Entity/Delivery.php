<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeliveryRepository::class)
 */
class Delivery
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="deliveries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $deliveryGuy;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lang;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $attitude;

    /**
     * @ORM\Column(type="bigint")
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity=Command::class, inversedBy="delivery")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryGuy(): ?Utilisateur
    {
        return $this->deliveryGuy;
    }

    public function setDeliveryGuy(?Utilisateur $deliveryGuy): self
    {
        $this->deliveryGuy = $deliveryGuy;

        return $this;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    public function getAttitude(): ?string
    {
        return $this->attitude;
    }

    public function setAttitude(string $attitude): self
    {
        $this->attitude = $attitude;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCommande(): ?Command
    {
        return $this->commande;
    }

    public function setCommande(Command $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
}
