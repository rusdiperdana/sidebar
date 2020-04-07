<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NdKataDasarRepository")
 */
class NdKataDasar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $kataDasar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $keterangan;

    /**
     * @ORM\Column(type="integer", options={"default"="1","comment"="1=aktif; 0=tidak aktif;"})
     */
    private $statusKata;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKataDasar(): ?string
    {
        return $this->kataDasar;
    }

    public function setKataDasar(?string $kataDasar): self
    {
        $this->kataDasar = $kataDasar;

        return $this;
    }

    public function getKeterangan(): ?string
    {
        return $this->keterangan;
    }

    public function setKeterangan(?string $keterangan): self
    {
        $this->keterangan = $keterangan;

        return $this;
    }

    public function getStatusKata(): ?int
    {
        return $this->statusKata;
    }

    public function setStatusKata(int $statusKata): self
    {
        $this->statusKata = $statusKata;

        return $this;
    }
}
