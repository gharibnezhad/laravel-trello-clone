<?php

namespace Web\User\Repositories;

use Web\User\Contracts\EmailChangeRepositoryInterface;
use Web\User\Models\EmailChange;

class EmailChangeRepository implements EmailChangeRepositoryInterface
{

    public function findById(int $id): ?EmailChange
    {
        return EmailChange::find($id);
    }

    public function findByTokenHash(string $tokenHash): ?EmailChange
    {
        /** @var EmailChange|null $emailChange */
        $emailChange = EmailChange::query()
            ->where('token_hash',$tokenHash)
            ->first();
        return $emailChange;
    }


    public function findByTokenHashForUpdate(string $tokenHash): ?EmailChange
    {
        /** @var EmailChange|null $emailChange */
        $emailChange = EmailChange::query()
            ->where('token_hash', $tokenHash)
            ->lockForUpdate()
            ->first();

        return $emailChange;
    }


    public function findByApproveTokenHash(string $approveTokenHash): ?EmailChange
    {
        /** @var EmailChange|null $emailChange */
        $emailChange = EmailChange::query()
            ->where('approve_token_hash', $approveTokenHash)
            ->first();

        return $emailChange;
    }
    public function findByApproveTokenHashForUpdate(string $approveTokenHash): ?EmailChange
    {
        /** @var EmailChange|null $emailChange */
        $emailChange = EmailChange::query()
            ->where('approve_token_hash', $approveTokenHash)
            ->lockForUpdate()
            ->first();

        return $emailChange;
    }

    public function findByDenyTokenHash(string $denyTokenHash): ?EmailChange
    {
        /** @var EmailChange|null $emailChange */
        $emailChange = EmailChange::query()
            ->where('deny_token_hash', $denyTokenHash)
            ->first();

        return $emailChange;
    }
    public function findByDenyTokenHashForUpdate(string $denyTokenHash): ?EmailChange
    {
        /** @var EmailChange|null $emailChange */
        $emailChange = EmailChange::query()
            ->where('deny_token_hash', $denyTokenHash)
            ->lockForUpdate()
            ->first();

        return $emailChange;
    }

    public function findPendingByUser(int $userId): ?EmailChange
    {
        return EmailChange::query()
            ->where('user_id', $userId)
            ->pending()
            ->latest('id')
            ->first();
    }

    public function create(array $data): EmailChange
    {
        return EmailChange::create($data);
    }


    public function update(int $id,array $data): EmailChange
    {
        $emailChange = EmailChange::findOrFail($id);
        $emailChange->update($data);
        return $emailChange;
    }



}
