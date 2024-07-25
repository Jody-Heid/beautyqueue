<?php

namespace App\Repositories;

use App\Interface\HairstylistRepositoryInterface;
use App\Models\Hairstylist;
use Illuminate\Database\Eloquent\Collection;

class HairstylistRepository implements HairstylistRepositoryInterface
{
    public function getAllHairstylists(): Collection
    {
        return Hairstylist::all();
    }

    public function getHairstylistById(int|string $id): Hairstylist
    {
        return Hairstylist::findOrFail($id);
    }

    public function getHairstylistByEmail(string $email): Hairstylist
    {
        return Hairstylist::where('email')->firstOrFail();
    }

    public function getHairstylistByCellphoneNumber(string $cellphoneNumber): Hairstylist
    {
        return Hairstylist::where('cellphone_number', $cellphoneNumber)->firstOrFail();
    }

    public function createHairstylist(array $hairstylistDetails): Hairstylist
    {
        return Hairstylist::create($hairstylistDetails);
    }

    public function updateHairstylist(array $newDetails, Hairstylist $hairstylist): Hairstylist
    {
        $hairstylist->update($newDetails);

        return $hairstylist;
    }

    public function deleteHairstylist(Hairstylist $hairstylist): void
    {
        $hairstylist->delete();
    }
}
