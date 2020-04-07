<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommondJobPositionRepository")
 */
class CommondJobPosition
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
    private $namaPosisi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Jabatan;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Parent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamaPosisi(): ?string
    {
        return $this->namaPosisi;
    }

    public function setNamaPosisi(string $namaPosisi): self
    {
        $this->namaPosisi = $namaPosisi;

        return $this;
    }

    public function getJabatan(): ?string
    {
        return $this->Jabatan;
    }

    public function setJabatan(string $jabatan): self
    {
        $this->Jabatan = $jabatan;

        return $this;
    }

    public function getParent(): ?string
    {
        return $this->Parent;
    }

    public function setParent(?string $Parent): self
    {
        $this->Parent = $Parent;

        return $this;
    }
}
