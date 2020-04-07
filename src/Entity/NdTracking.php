<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NdTrackingRepository")
 */
class NdTracking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idUser;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idJabatan;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NdSurat",cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $refid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(?int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdJabatan(): ?int
    {
        return $this->idJabatan;
    }

    public function setIdJabatan(?int $idJabatan): self
    {
        $this->idJabatan = $idJabatan;

        return $this;
    }

    public function getRefid(): ?NdSurat
    {
        return $this->refid;
    }

    public function setRefid(?NdSurat $refid): self
    {
        $this->refid = $refid;

        return $this;
    }
}
