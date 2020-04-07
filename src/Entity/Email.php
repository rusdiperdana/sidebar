<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmailRepository")
 */
class Email
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $yourName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subyek;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pesan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYourName(): ?string
    {
        return $this->yourName;
    }

    public function setYourName(string $yourName): self
    {
        $this->yourName = $yourName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubyek(): ?string
    {
        return $this->subyek;
    }

    public function setSubyek(string $subyek): self
    {
        $this->subyek = $subyek;

        return $this;
    }

    public function getPesan(): ?string
    {
        return $this->pesan;
    }

    public function setPesan(string $pesan): self
    {
        $this->pesan = $pesan;

        return $this;
    }
}
