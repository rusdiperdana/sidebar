<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NdHistoryRepository")
 */
class NdHistory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $userNama;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $komentar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aksi;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NdSurat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $refid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserNama(): ?int
    {
        return $this->userNama;
    }

    public function setUserNama(int $userNama): self
    {
        $this->userNama = $userNama;

        return $this;
    }

    public function getKomentar(): ?string
    {
        return $this->komentar;
    }

    public function setKomentar(?string $komentar): self
    {
        $this->komentar = $komentar;

        return $this;
    }

    public function getAksi(): ?string
    {
        return $this->aksi;
    }

    public function setAksi(?string $aksi): self
    {
        $this->aksi = $aksi;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getRefid(): ?ndSurat
    {
        return $this->refid;
    }

    public function setRefid(?ndSurat $refid): self
    {
        $this->refid = $refid;

        return $this;
    }
}
