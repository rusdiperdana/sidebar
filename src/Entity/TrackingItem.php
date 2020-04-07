<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrackingItemRepository")
 */
class TrackingItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTglBuat(): ?\DateTimeInterface
    {
        return $this->getTglBuat();
    }

    public function setTglBuat(? \DateTimeInterface $tglBuat): self
    {
        $this->tglBuat = $tglBuat;

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

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(?int $step): self
    {
        $this->step = $step;

        return $this;
    }

    public function getPemeriksadaftar()
    {
        return $this->pemeriksadaftar;
    }

    public function setPemeriksadaftar($pemeriksadaftar)
    {
        $this->pemeriksadaftar = $pemeriksadaftar;
    }

    public function getRefid(): ?string
    {
        return $this->refid;
    }

    public function setRefid(?string $refid): self
    {
        $this->refid = $refid;

        return $this;
    }
}
