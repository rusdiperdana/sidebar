<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SuratKelurahanRepository")
 */
class SuratKelurahan
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
    private $tahun;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ndSurat", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $refid;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setRefid(ndSurat $refid): self
    {
        $this->refid = $refid;

        return $this;
    }
}
