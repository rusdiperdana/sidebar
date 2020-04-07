<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NdPenerimaRepository")
 */
class NdPenerima
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
    private $penerimaNama;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\NdSurat", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $refid;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default"="1","comment"="1=kepada; 2=tembusan;"})
     */
    private $tipePenerima;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $penerimaJabatan;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $penerimaText;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPenerimaNama(): ?int
    {
        return $this->penerimaNama;
    }

    public function setPenerimaNama(int $penerimaNama): self
    {
        $this->penerimaNama = $penerimaNama;

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

    public function getTipePenerima(): ?int
    {
        return $this->tipePenerima;
    }

    public function setTipePenerima(?int $tipePenerima): self
    {
        $this->tipePenerima = $tipePenerima;

        return $this;
    }

    public function getPenerimaJabatan(): ?int
    {
        return $this->penerimaJabatan;
    }

    public function setPenerimaJabatan(?int $penerimaJabatan): self
    {
        $this->penerimaJabatan = $penerimaJabatan;

        return $this;
    }

    public function getPenerimaText(): ?string
    {
        return $this->penerimaText;
    }

    public function setPenerimaText(?string $penerimaText): self
    {
        $this->penerimaText = $penerimaText;

        return $this;
    }
}
