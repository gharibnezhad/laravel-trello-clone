<?php

namespace Web\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\RolePermissions\Repositories\RoleRepository;
use Web\User\Http\Requests\UpdateProfileInformationRequest;
use Web\User\Http\Requests\UpdateUserPhoto;
use Web\User\Models\User;
use Web\User\Services\UserService;

class UserController extends Controller
{
    protected $userService;
    protected $roleRepo;

    public function __construct(UserService $userService,RoleRepository $roleRepo)
    {
        $this->userService = $userService;
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $this->authorize('index',User::class);
        $users = $this->userService->paginate();
        return view('User::Admin.index',compact('users'));
    }

    public function edit($id)
    {
        $this->authorize('edit',User::class);
        $user = $this->userService->findById($id);
        $roles = $this->roleRepo->getRole();

        return view('User::Admin.edit',compact('user','roles'));
    }

    public function update(Request $request,$userid)
    {
        $this->authorize('update',User::class);
        $this->userService->updateUser($request,$userid);
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $this->authorize('delete',User::class);
        $this->userService->delete($id);
        return response()->json([
            'status' => 'success',
            'message' => 'کاربر با موفقیت حذف شد.'
        ]);
    }

    public function manualVerify($id)
    {
        $this->authorize('manualVerify',User::class);
        $this->userService->verifyEmail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'کاربر با موفقیت تایید شد.'
        ]);
    }

    public function profile()
    {
        $user = auth()->user();
        $this->authorize('view',$user);
        return view('User::Admin.profile',compact('user'));
    }

    public function editProfile($id)
    {
        $user = $this->userService->findById($id);
        $this->authorize('editProfile',$user);
        return view('User::Admin.editProfile',compact('user'));
    }


    public function updateProfile(UpdateProfileInformationRequest $request,User $user)
    {
        $this->authorize('updateProfile',$user);
       $this->userService->updateProfile($request,$user->id);
        return redirect()->route('users.profile');
    }

    public function updatePhoto(UpdateUserPhoto $request)
    {
        $this->userService->updateUserPhoto($request);
        return back();
    }

}
