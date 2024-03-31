<?php

namespace App\Services;

use App\Repositories\RankRepository;

class RankService
{
    public function __construct(
        protected RankRepository $rankRepository,
    )
    {
    }

    public function create($data)
    {
        return $this->rankRepository->create($data);
    }

    public function update($data, $id)
    {
        return $this->rankRepository->update($data, $id);
    }

    public function findBy(string $type, int $userId, int $entityId)
    {
        return $this->rankRepository->findBy($type, $userId, $entityId);
    }

    public function rateCounts(string $type, string $rate, int $entityId): int
    {
        return $this->rankRepository->rateCounts($type, $rate, $entityId);
    }
}
