<?php
declare(strict_types=1);

namespace App\Controller;


use App\Repository\StagesRepository;

class StagesClientsCountAction
{
    public function __invoke(StagesRepository $repository): array
    {
      return [

          'just-added' => $repository->clientsCount('just added'),
          'price-proposal' => $repository->clientsCount('price proposal'),
          'negotiation' => $repository->clientsCount('negotiation'),
          'closed-lost' => $repository->clientsCount('closed lost'),
          'closed-win' => $repository->clientsCount('closed win'),
          'black-list' => $repository->clientsCount('black list'),
          ];
    }
}