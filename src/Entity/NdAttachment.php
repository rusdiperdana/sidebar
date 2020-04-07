<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NdAttachmentRepository")
 */
class NdAttachment
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
    private $namaFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipeFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ndSurat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $refid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamaFile(): ?string
    {
        return $this->namaFile;
    }

    public function setNamaFile(?string $namaFile): self
    {
        $this->namaFile = $namaFile;

        return $this;
    }

    public function getTipeFile(): ?string
    {
        return $this->tipeFile;
    }

    public function setTipeFile(string $tipeFile): self
    {
        $this->tipeFile = $tipeFile;

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
