<?php

namespace Web\User\Services;

use Web\Media\Service\MediaFileService;
use Web\User\Contracts\UserInterface;
use Web\User\Models\User;

class UserService
{

    protected $userRepo;

    public function __construct(UserInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function findById($id)
    {
        return $this->userRepo->findById($id);
    }

    public function paginate()
    {
        return $this->userRepo->paginate();
    }

    public function updateUser($request, $userId)
    {
        $user = $this->userRepo->findById($userId);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'mobile' => $request->mobile,
            'status' => $request->status,
        ];
        $user = $this->userRepo->update($user, $data);
        if ($request->has('role'))
            $user->roles()->sync($request->role);

        return $user;
    }

    public function delete($id)
    {
        return $this->userRepo->delete($id);
    }

    public function verifyEmail($id)
    {
        $user = $this->userRepo->findById($id);
        return $user->markEmailAsVerified();
    }

    public function updateProfile($request, $id)
    {
        $user = $this->findById($id);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'mobile' => $request->mobile,
        ];

        if (!empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        }
        return $this->userRepo->update($user, $data);
    }

    public function updateUserPhoto($request)
    {
        $user = auth()->user();
        $media = MediaFileService::publicUpload($request->file('userPhoto'));
        if ($user->image) {
            $user->image->delete();
        }
        $user->image_id = $media->id;
        $user->save();
        return $user;
    }


    public function getProfile(): User
    {
        $user = auth()->user();
        return $this->userRepo->getProfileWithRelations($user);
    }


}
