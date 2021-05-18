<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\StagesClientsCountAction;
use App\Repository\StagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StagesRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'get',
        'post',
        'stagesCount'=>[
            'method'=>'get',
            'path'=>'stages/count',
            'controller'=>StagesClientsCountAction::class
        ]
    ],
    itemOperations: ['get','delete'],
    denormalizationContext: ['groups'=>['stages:write']],
    normalizationContext: ['groups'=>['stages:read']]

)]

class Stages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['stages:read'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['stages:read','stages:write'])]
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Clients::class, mappedBy="stage")
     */
    #[Groups(['stages:read'])]
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
            $client->setStage($this);
        }

        return $this;
    }

    public function removeClient(Clients $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getStage() === $this) {
                $client->setStage(null);
            }
        }

        return $this;
    }
}
