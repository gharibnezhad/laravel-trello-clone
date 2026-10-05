<?php

namespace Web\User\Contracts;

use Web\User\Models\EmailChange;

interface EmailChangeRepositoryInterface
{

    public function findById(int $id): ?EmailChange;

    public function findByTokenHash(string $tokenHash): ?EmailChange;
    public function findByTokenHashForUpdate(string $tokenHash): ?EmailChange;


    public function findByApproveTokenHash(string $approveTokenHash): ?EmailChange;
    public function findByApproveTokenHashForUpdate(string $approveTokenHash): ?EmailChange;

    public function findByDenyTokenHash(string $denyTokenHash): ?EmailChange;
    public function findByDenyTokenHashForUpdate(string $denyTokenHash): ?EmailChange;



    public function findPendingByUser(int $userId): ?EmailChange;
    public function create(array $data): EmailChange;

    public function update(int $id,array $data): EmailChange;
}

