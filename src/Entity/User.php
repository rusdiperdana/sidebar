<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Role;

    /**
     * @ORM\Column(type="integer")
     */
    private $Phone;

    /**
     * @ORM\Column(type="integer" , options={"default"="1","comment"="1=aktif; 0=tidak aktif; 2=proses"})
     */
    private $statusPegawai;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ussername;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CommondJobPosition")
     * @ORM\JoinColumn(nullable=false)
     */
    private $IdJobPosition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $namaPegawai;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getRoles():array
    {
        return[
            'ROLE_USER', $this->getRole()
        ];
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getRole(): ?string
    {
        return $this->Role;
    }

    public function setRole(string $Role): self
    {
        $this->Role = $Role;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->Phone;
    }

    public function setPhone(int $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getStatusPegawai(): ?int
    {
        return $this->statusPegawai;
    }

    public function setStatusPegawai(int $statusPegawai): self
    {
        $this->statusPegawai = $statusPegawai;

        return $this;
    }

    public function getUssername(): ?string
    {
        return $this->Ussername;
    }

    public function setUssername(string $Ussername): self
    {
        $this->Ussername = $Ussername;

        return $this;
    }

    public function getIdJobPosition(): ?CommondJobPosition
    {
        return $this->IdJobPosition;
    }

    public function setIdJobPosition(?CommondJobPosition $IdJobPosition): self
    {
        $this->IdJobPosition = $IdJobPosition;

        return $this;
    }

    public function getNamaPegawai(): ?string
    {
        return $this->namaPegawai;
    }

    public function setNamaPegawai(string $namaPegawai): self
    {
        $this->namaPegawai = $namaPegawai;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }
}
