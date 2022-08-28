<?php

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\Admin\RoomRepository")
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\NotBlank
     * @Assert\NotNull()
     * @Assert\Length(
     * min = 6,
     * max = 25,
     * minMessage = "Votre title doit contenir au minimum  {{ limit }} caractéres",
     * maxMessage = "Votre title doit contenir au maximum {{ limit }} caractéres"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hotelid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\NotNull()
     * @Assert\Length(
     * min = 2,
     * max = 255,
     * minMessage = "Votre description doit contenir au minimum  {{ limit }} caractéres",
     * maxMessage = "Votre description doit contenir au maximum {{ limit }} caractéres"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="float", nullable=false)
     * @Assert\NotBlank
     * @Assert\NotNull()
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getHotelid(): ?int
    {
        return $this->hotelid;
    }

    public function setHotelid(?int $hotelid): self
    {
        $this->hotelid = $hotelid;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }
}
