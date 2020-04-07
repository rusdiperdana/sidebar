<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SuratRWRepository")
 */
class SuratRW
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
    private $IdJobPosition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $keterangan;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tahun;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\NdSurat", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $refid;

    /**
     * @ORM\Column(type="integer")
     */
    private $idUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdJobPosition(): ?int
    {
        return $this->IdJobPosition;
    }

    public function setIdJobPosition(int $IdJobPosition): self
    {
        $this->IdJobPosition = $IdJobPosition;

        return $this;
    }

    public function getKeterangan(): ?string
    {
        return $this->keterangan;
    }

    public function setKeterangan(string $keterangan): self
    {
        $this->keterangan = $keterangan;

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

    public function getTahun(): ?string
    {
        return $this->tahun;
    }

    public function setTahun(string $tahun): self
    {
        $this->tahun = $tahun;

        return $this;
    }

    public function getRefid(): ?ndSurat
    {
        return $this->refid;
    }

    public function setRefid(ndSurat $refid): self
    {
        $this->refid = $refid;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
