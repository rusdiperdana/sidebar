<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NdSuratRepository")
 */
class NdSurat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,  nullable=true)
     */
    private $noSuratRt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $noSuratRw;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bodySurat;

    /**
     *
     * @ORM\Column(type="integer")
     */
    private $step;
    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $noSuratKeterangan;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $keterangan;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tglSelesaiRT;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tglSelesaiRW;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tglSelesaiKelurahan;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Penduduk")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pemohonSurat;

    /**
     * @ORM\Column(type="string" , length=255)
     */
    private $noPengajuan;

    /**
     * @ORM\Column(type="integer")
     */
    private $Tipe;

    private $tembusandaftar;
    private $kepadadaftar;
    private $pemeriksadaftar;
    private $komentar;
    private $pengirim;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tglBuat;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $tglSelesai;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StatusSurat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSuratStatus", referencedColumnName="id")
     * })
     */
    private $IdSuratStatus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pengirimNamaText;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reject_step;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoSuratRt(): ?string
    {
        return $this->noSuratRt;
    }

    public function setNoSuratRt(string $noSuratRt): self
    {
        $this->noSuratRt = $noSuratRt;

        return $this;
    }

    public function getNoSuratRw(): ?string
    {
        return $this->noSuratRw;
    }

    public function setNoSuratRw(string $noSuratRw): self
    {
        $this->noSuratRw = $noSuratRw;

        return $this;
    }

    public function getBodySurat(): ?string
    {
        return $this->bodySurat;
    }

    public function setBodySurat(string $bodySurat): self
    {
        $this->bodySurat = $bodySurat;

        return $this;
    }

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(int $step): self
    {
        $this->step = $step;

        return $this;
    }

    public function getNoSuratKeterangan(): ?string
    {
        return $this->noSuratKeterangan;
    }

    public function setNoSuratKeterangan(string $noSuratKeterangan): self
    {
        $this->noSuratKeterangan = $noSuratKeterangan;

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

    public function getTglSelesaiRT(): ?\DateTimeInterface
    {
        return $this->tglSelesaiRT;
    }

    public function setTglSelesaiRT(?\DateTimeInterface $tglSelesaiRT): self
    {
        $this->tglSelesaiRT = $tglSelesaiRT;

        return $this;
    }

    public function getTglSelesaiRW(): ?\DateTimeInterface
    {
        return $this->tglSelesaiRW;
    }

    public function setTglSelesaiRW(?\DateTimeInterface $tglSelesaiRW): self
    {
        $this->tglSelesaiRW = $tglSelesaiRW;

        return $this;
    }

    public function getTglSelesaiKelurahan(): ?\DateTimeInterface
    {
        return $this->tglSelesaiKelurahan;
    }

    public function setTglSelesaiKelurahan(?\DateTimeInterface $tglSelesaiKelurahan): self
    {
        $this->tglSelesaiKelurahan = $tglSelesaiKelurahan;

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

    public function getPemohonSurat(): ?Penduduk
    {
        return $this->pemohonSurat;
    }

    public function setPemohonSurat(?Penduduk $pemohonSurat): self
    {
        $this->pemohonSurat = $pemohonSurat;

        return $this;
    }

    public function getNoPengajuan(): ?string
    {
        return $this->noPengajuan;
    }

    public function setNoPengajuan(string $noPengajuan): self
    {
        $this->noPengajuan = $noPengajuan;

        return $this;
    }

    public function getTipe(): ?int
    {
        return $this->Tipe;
    }

    public function setTipe(int $Tipe): self
    {
        $this->Tipe = $Tipe;

        return $this;
    }

    public function getTembusandaftar()
    {
        return $this->tembusandaftar;
    }

    public function setTembusandaftar($tembusandaftar)
    {
        $this->tembusandaftar =$tembusandaftar;
    }

    public function getKepadadaftar()
    {
        return $this->kepadadaftar;
    }

    public function setKepadadaftar($kepadadaftar)
    {
        $this->kepadadaftar = $kepadadaftar;
    }

    public function getPemeriksadaftar()
    {
        return $this->pemeriksadaftar;
    }

    public function setPemeriksadaftar($pemeriksadaftar)
    {
        $this->pemeriksadaftar = $pemeriksadaftar;
    }

    public function getKomentar()
    {
        return $this->komentar;
    }

    public function setKomentar($komentar)
    {
        $this->komentar = $komentar;
    }

    public function getTglBuat(): ?\DateTimeInterface
    {
        return $this->tglBuat;
    }

    public function setTglBuat(?\DateTimeInterface $tglBuat): self
    {
        $this->tglBuat = $tglBuat;

        return $this;
    }

    public function getTglSelesai(): ?\DateTimeInterface
    {
        return $this->tglSelesai;
    }

    public function setTglSelesai(?\DateTimeInterface $tglSelesai): self
    {
        $this->tglSelesai = $tglSelesai;

        return $this;
    }

    public function getIdSuratStatus(): ?StatusSurat
    {
        return $this->IdSuratStatus;
    }

    public function setIdSuratStatus(?StatusSurat $IdSuratStatus): self
    {
        $this->IdSuratStatus = $IdSuratStatus;

        return $this;
    }

    public function getPengirimNamaText(): ?string
    {
        return $this->pengirimNamaText;
    }

    public function setPengirimNamaText(?string $pengirimNamaText): self
    {
        $this->pengirimNamaText = $pengirimNamaText;

        return $this;
    }

    public function getPengirim()
    {
        return $this->pengirim;
    }

    public function setPengirim($pengirim)
    {
        $this->pengirim = $pengirim;
    }

    public function getRejectStep(): ?int
    {
        return $this->reject_step;
    }

    public function setRejectStep(?int $reject_step): self
    {
        $this->reject_step = $reject_step;

        return $this;
    }
}

