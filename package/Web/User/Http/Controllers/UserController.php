<?php

namespace Web\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\RolePermissions\Repositories\RoleRepository;
use Web\User\Http\Requests\ConfirmPasswordRequest;
use Web\User\Http\Requests\UpdateProfileInformationRequest;
use Web\User\Http\Requests\UpdateUserPhoto;
use Web\User\Models\User;
use Web\User\Services\EmailChangeService;
use Web\User\Services\PasswordConfirmationService;
use Web\User\Services\UserService;

class UserController extends Controller
{
    protected $userService;
    protected $roleRepo;

    public function __construct(UserService                  $userService,
                                RoleRepository               $roleRepo,
                                protected EmailChangeService $emailChangeService
    )
    {
        $this->userService = $userService;
        $this->roleRepo = $roleRepo;
    }

    public function index()
    {
        $this->authorize('index', User::class);
        $users = $this->userService->paginate();
        return view('User::Admin.index', compact('users'));
    }

    public function edit($id)
    {
        $this->authorize('edit', User::class);
        $user = $this->userService->findById($id);
        $roles = $this->roleRepo->getRole();

        return view('User::Admin.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $userid)
    {
        $this->authorize('update', User::class);
        $this->userService->updateUser($request, $userid);
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $this->authorize('delete', User::class);
        $this->userService->delete($id);
        return response()->json([
            'status' => 'success',
            'message' => 'کاربر با موفقیت حذف شد.'
        ]);
    }

    public function manualVerify($id)
    {
        $this->authorize('manualVerify', User::class);
        $this->userService->verifyEmail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'کاربر با موفقیت تایید شد.'
        ]);
    }

    public function profile()
    {
        $user = $this->userService->getProfile();
        $this->authorize('view', $user);
        return view('User::Admin.profile', compact('user'));
    }

    public function editProfile($id)
    {
        $user = $this->userService->findById($id);
        $this->authorize('editProfile', $user);
        return view('User::Admin.editProfile', compact('user'));
    }


    public function updateProfile(
        UpdateProfileInformationRequest $request,
        User                            $user,
        PasswordConfirmationService     $confirmation
    )
    {
        $this->authorize('updateProfile', $user);
        $this->userService->updateProfile($request, $user->id);
        $confirmation->forget();
        return redirect()->route('users.profile');
    }

    public function confirmPassword(
        ConfirmPasswordRequest      $request,
        PasswordConfirmationService $confirmation)
    {
        $confirmation->confirm();

        return response()->json([
            "success" => true
        ]);
    }

    public function updatePhoto(UpdateUserPhoto $request)
    {
        $this->userService->updateUserPhoto($request);
        return back();
    }



    public function requestEmailChange(Request $request, User $user)
    {
        $this->authorize('updateProfile', $user);
        $request->validate([
            'email' => ['required', 'email', 'different:' . $user->email,],]);
        $this->emailChangeService->request($user, $request->email);
        return response()->json([
            'success' => true,
            'message' => 'A confirmation link has been sent to your new email address.',
        ]);
    }

    public function approve(string $token)
    {
        $this->emailChangeService->approve($token);

        return redirect()->route('login')->with('status',
                'Your email change request has been approved.
                A confirmation link has been sent to your new email address.');
    }


    public function confirm(string $token)
    {
        $emailChange = $this->emailChangeService->confirm($token);
        return redirect()->route('login')->with('status',
            'Your email address has been changed successfully.');
    }

    public function deny(string $token)
    {
        $this->emailChangeService->deny($token);
        return redirect()
            ->route('users.profile')
            ->with(
                'status',
                'Your email change request has been cancelled.'
            );
    }




}
