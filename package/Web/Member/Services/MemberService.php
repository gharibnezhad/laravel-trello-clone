<?php

namespace Web\Member\Services;

use Web\Member\Contracts\MemberInterface;

class MemberService
{

    protected $memberRepo;

    public function __construct(MemberInterface $memberRepo)
    {
        $this->memberRepo = $memberRepo;
    }

    public function getMember($id,$type)
    {
        return $this->memberRepo->getMember([
            'type' => $type,
            'id'=> $id
        ]);
    }

    public function addMember($type,$id,$userId)
    {
        return $this->memberRepo->addMember($type,$id,$userId);
    }

    public function removeMember($type,$id,$userId)
    {
        return $this->memberRepo->removeMember($type,$id,$userId);
    }
}
