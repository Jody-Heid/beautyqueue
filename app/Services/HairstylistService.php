<?php

namespace App\Services;

use App\Interface\HairstylistRepositoryInterface;
use App\Models\Hairstylist;
use Illuminate\Database\Eloquent\Collection;

class HairstylistService
{
    public function __construct(
        private readonly HairstylistRepositoryInterface $hairstylistService
    ) {
    }

    public function listHairstylists(): Collection
    {
        return $this->hairstylistService->getAllHairstylists();
    }

    public function createHairstylist(array $adminData): Hairstylist
    {
        return $this->hairstylistService->createHairstylist($adminData);
    }

    public function getHairstylistById(string|int $id): Hairstylist
    {
        return $this->hairstylistService->getHairstylistById($id);
    }

    public function updateHairstylist(array $hairstylistDetails, Hairstylist $hairstylist): Hairstylist
    {
        return $this->hairstylistService->updateHairstylist($hairstylistDetails, $hairstylist);
    }

    public function destroyHairstylist(Hairstylist $hairstylist): void
    {
        $this->hairstylistService->deleteHairstylist($hairstylist);

    }
}
