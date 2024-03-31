<?php

namespace App\Interfaces;


use App\Models\Rank;

interface RankRepositoryInterface
{
    public function create(array $data);

    public function findBy(string $type, int $userId, int $entityId);

    public function rateCounts(string $type, string $rate, int $entityId);

    public function update(array $data, $id);

    public function find($id);

}
