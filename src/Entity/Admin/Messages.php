<?php

namespace App\Entity\Admin;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Admin\MessagesRepository")
 */
class Messages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     * @Assert\NotBlank
     * @Assert\NotNull()
     * @Assert\Length(
     * min = 2,
     * max = 25,
     * minMessage = "Votre nom doit contenir au minimum  {{ limit }} caractéres",
     * maxMessage = "Votre nom doit contenir au maximum {{ limit }} caractéres"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=75, nullable=false)
     * @Assert\NotBlank
     * @Assert\NotNull()
     * @Assert\Length(
     * min = 2,
     * max = 25,
     * minMessage = "Votre nom doit contenir au minimum  {{ limit }} caractéres",
     * maxMessage = "Votre nom doit contenir au maximum {{ limit }} caractéres"
     * )
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\NotNull()
     * @Assert\Length(
     * min = 2,
     * max = 255,
     * minMessage = "Votre nom doit contenir au minimum  {{ limit }} caractéres",
     * maxMessage = "Votre nom doit contenir au maximum {{ limit }} caractéres"
     * )
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

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

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
