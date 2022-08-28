<?php

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Admin\CommentRepository")
 */
class AllComment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    public $subject;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $comment;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    public $status;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    public $ip;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $userid;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $updated_at;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $rate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $hotelid;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    public $name;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    public $surname;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    public $title;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

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

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(?int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = new \DateTime("now");

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = new \DateTime("now");

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): self
    {
        $this->rate = $rate;

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
    public function getName(): ?string
    {
        return $this->subject;
    }

    public function setName(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }
    public function getSurname(): ?string
    {
        return $this->subject;
    }

    public function setSurname(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }
    public function getTitle(): ?string
    {
        return $this->subject;
    }

    public function setTitle(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }
}
