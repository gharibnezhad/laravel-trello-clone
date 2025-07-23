<?php

namespace Web\Member\Contracts;

interface MemberInterface
{
    public function getMember($data);

    public function addMember($type, $id, $userId);

    public function removeMember($type, $id, $userId);

}
