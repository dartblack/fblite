<?php

namespace App\Repositories;

use App\Interfaces\RankRepositoryInterface;
use App\Models\Rank;

class RankRepository implements RankRepositoryInterface
{

    public function create(array $data)
    {
        return Rank::create($data);
    }

    public function findBy(string $type, int $userId, int $entityId)
    {
        $rank = Rank::query();
        $rank->with('user');
        $rank->where('type', '=', $type)
            ->where('user_id', '=', $userId)
            ->where('entity_id', '=', $entityId);
        return $rank->first();
    }


    public function rateCounts(string $type, string $rate, int $entityId)
    {
        $rank = Rank::query();
        $rank->where('type', '=', $type)
            ->where('rate', '=', $rate)
            ->where('entity_id', '=', $entityId);
        return $rank->count();
    }

    public function update(array $data, $id)
    {
        $rate = $this->find($id);
        $rate->update($data);
        return $rate;
    }

    public function find($id)
    {
        return Rank::findOrFail($id);
    }
}
