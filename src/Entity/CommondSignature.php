<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommondSignatureRepository")
 */
class CommondSignature
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
    private $fileName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ussername;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getUssername(): ?string
    {
        return $this->Ussername;
    }

    public function setUssername(string $ussername): self
    {
        $this->Ussername = $ussername;

        return $this;
    }

}
