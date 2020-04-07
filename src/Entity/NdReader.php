<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NdReaderRepository")
 */
class NdReader
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
    private $readerNama;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NdSurat",cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $refid;

    /**
     * @ORM\Column(type="integer", nullable=true,options={"default"="1","comment"="1=read; 0=not read;"})
     */
    private $readerStatus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $readerJabatan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReaderNama(): ?int
    {
        return $this->readerNama;
    }

    public function setReaderNama(int $readerNama): self
    {
        $this->readerNama = $readerNama;

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

    public function getReaderStatus(): ?int
    {
        return $this->readerStatus;
    }

    public function setReaderStatus(?int $readerStatus): self
    {
        $this->readerStatus = $readerStatus;

        return $this;
    }

    public function getReaderJabatan(): ?int
    {
        return $this->readerJabatan;
    }

    public function setReaderJabatan(?int $readerJabatan): self
    {
        $this->readerJabatan = $readerJabatan;

        return $this;
    }
}
