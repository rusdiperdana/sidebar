<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NdApproverRepository")
 */
class NdApprover
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
    private $approverNama;

    /**
     * @ORM\Column(type="integer")
     */
    private $sequence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NdSurat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $refid;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"default"="1","comment"="1=pemeriksa;0=konseptor;"})
     */
    private $tipeApprover;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ApproverJabatan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApproverNama(): ?int
    {
        return $this->approverNama;
    }

    public function setApproverNama(int $approverNama): self
    {
        $this->approverNama = $approverNama;

        return $this;
    }

    public function getSequence(): ?int
    {
        return $this->sequence;
    }

    public function setSequence(int $sequence): self
    {
        $this->sequence = $sequence;

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

    public function getTipeApprover(): ?int
    {
        return $this->tipeApprover;
    }

    public function setTipeApprover(?int $tipeApprover): self
    {
        $this->tipeApprover = $tipeApprover;

        return $this;
    }

    public function getApproverJabatan(): ?int
    {
        return $this->ApproverJabatan;
    }

    public function setApproverJabatan(?int $ApproverJabatan): self
    {
        $this->ApproverJabatan = $ApproverJabatan;

        return $this;
    }
}
