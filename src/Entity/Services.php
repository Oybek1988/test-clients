<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\StagesClientsCountAction;
use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity( repositoryClass=ServicesRepository::class)
 */
#[ApiResource(
    collectionOperations: [
    'get',
    'post',
    'servicesCount'=>[
        'method'=>'get',
        'path'=>'services/count',
        'controller'=>StagesClientsCountAction::class
    ]
],
    itemOperations: ['get','delete'],
    denormalizationContext: ['groups'=>['stages:write']],
    normalizationContext: ['groups'=>['stages:read']])]
class Services
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['services:read'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['services:read'])]
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Clients::class, mappedBy="serviceType")
     */
    #[Groups(['services:read'])]
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

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

    /**
     * @return Collection|Clients[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Clients $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setServiceType($this);
        }

        return $this;
    }

    public function removeClient(Clients $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getServiceType() === $this) {
                $client->setServiceType(null);
            }
        }

        return $this;
    }
}
