<?php
declare(strict_types=1);

namespace App\Controller;


use App\Repository\StagesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class StagesClientsCountAction
{
    public function __invoke(StagesRepository $repository, SerializerInterface $serializer): Response
    {

      $data=$serializer->serialize(
       [

          'just-added' => $repository->clientsCount('just added'),
          'price-proposal' => $repository->clientsCount('price proposal'),
          'negotiation' => $repository->clientsCount('negotiation'),
          'closed-lost' => $repository->clientsCount('closed lost'),
          'closed-win' => $repository->clientsCount('closed win'),
          'black-list' => $repository->clientsCount('black list'),
          ],
          'json'
    );
      return new Response($data);
    }
}