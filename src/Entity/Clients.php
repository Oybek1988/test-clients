<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClientsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ClientsRepository::class)
 */
#[ApiResource(
    denormalizationContext: ['groups'=>['clients:write']],
    normalizationContext: ['groups'=>['clients:read']]
)]
class Clients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['clients:read'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['clients:read','clients:write'])]
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['clients:read','clients:write'])]
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['clients:read','clients:write'])]
    private $companyName;

    /**
     * @ORM\ManyToOne(targetEntity=Stages::class, inversedBy="clients")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['clients:read'])]
    private $stage;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="clients")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['clients:read'])]
    private $serviceType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getStage(): ?Stages
    {
        return $this->stage;
    }

    public function setStage(?Stages $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getServiceType(): ?Services
    {
        return $this->serviceType;
    }

    public function setServiceType(?Services $serviceType): self
    {
        $this->serviceType = $serviceType;

        return $this;
    }
}
