<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PendudukRepository")
 */
class Penduduk
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
    private $NIK;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $namaPenduduk;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NoKK;

    /**
     * @ORM\Column(type="integer")
     */
    private $NoTelepon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alamat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pekerjaan;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $agama;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statusKawin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNIK(): ?string
    {
        return $this->NIK;
    }

    public function setNIK(string $NIK): self
    {
        $this->NIK = $NIK;

        return $this;
    }

    public function getNamaPenduduk(): ?string
    {
        return $this->namaPenduduk;
    }

    public function setNamaPenduduk(string $namaPenduduk): self
    {
        $this->namaPenduduk = $namaPenduduk;

        return $this;
    }

    public function getNoKK(): ?string
    {
        return $this->NoKK;
    }

    public function setNoKK(string $NoKK): self
    {
        $this->NoKK = $NoKK;

        return $this;
    }

    public function getNoTelepon(): ?int
    {
        return $this->NoTelepon;
    }

    public function setNoTelepon(int $NoTelepon): self
    {
        $this->NoTelepon = $NoTelepon;

        return $this;
    }

    public function getAlamat(): ?string
    {
        return $this->alamat;
    }

    public function setAlamat(string $alamat): self
    {
        $this->alamat = $alamat;

        return $this;
    }

    public function getPekerjaan(): ?string
    {
        return $this->pekerjaan;
    }

    public function setPekerjaan(string $pekerjaan): self
    {
        $this->pekerjaan = $pekerjaan;

        return $this;
    }

    public function getAgama(): ?string
    {
        return $this->agama;
    }

    public function setAgama(string $agama): self
    {
        $this->agama = $agama;

        return $this;
    }

    public function getStatusKawin(): ?string
    {
        return $this->statusKawin;
    }

    public function setStatusKawin(string $statusKawin): self
    {
        $this->statusKawin = $statusKawin;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

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
}
