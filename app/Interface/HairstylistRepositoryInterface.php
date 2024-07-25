<?php

namespace App\Interface;

use App\Models\Hairstylist;
use Illuminate\Database\Eloquent\Collection;

interface HairstylistRepositoryInterface
{
    /**
     * Gets all hairstylist.
     */
    public function getAllHairstylists(): Collection;

    /**
     * Retrieve an Hairstylist model instance by id.
     */
    public function getHairstylistById(int|string $id): Hairstylist;

    /**
     * Retrieve an Hairstylist model instance by email.
     */
    public function getHairstylistByEmail(string $email): Hairstylist;

    /**
     * Retrieve an Hairstylist model instance by cellphone number.
     */
    public function getHairstylistByCellphoneNumber(string $cellphoneNumber): Hairstylist;

    /**
     * Create a new Hairstylist.
     */
    public function createHairstylist(array $hairstylistDetails): Hairstylist;

    /**
     * Update an existing Hairstylist.
     */
    public function updateHairstylist(array $newDetails, Hairstylist $hairstylist): Hairstylist;

    /**
     * Remove an existing Hairstylist.
     */
    public function deleteHairstylist(Hairstylist $hairstylist): void;
}
