<?php

namespace Web\User\Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Web\RolePermissions\Database\Seeder\RolePermissionSeeder;
use Web\RolePermissions\Models\Permission;
use Web\RolePermissions\Models\Role;
use Web\User\Models\User;

class UserControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_permitted_can_user_see_users_index()
    {
        $this->actingAsAdmin();
        $this->get(route('users.index'))
            ->assertOk()
        ->assertViewIs('User::Admin.index');
    }

    public function test_permitted_can_admin_see_user_edit()
    {
        $this->actingAsAdmin();
        $user = User::factory()->create();
        $roles = Role::factory()->count(2)->create();

        $this->get(route('users.edit',$user->id),[
            'roles' => $roles
        ])
            ->assertOk()
            ->assertViewIs('User::Admin.edit')
            ->assertViewHas('roles',function ($viewRoles) use ($roles){
                return $roles->every(fn($role) => $viewRoles->contains($role)) ;
            });

    }


    public function test_permitted_can_admin_update_user()
    {
        $this->actingAsAdmin();
        $count = rand(1,3);
        $user = User::factory()
            ->hasRoles($count)
            ->create();
        $this->put(route('users.update',$user->id),[
            'name' => $user->name,
            'email' => $user->email,
            'username' => 'adminTest',
            'role' => 1
        ])->assertRedirect(route('users.index'));
        $user->refresh();
        $this->assertEquals('adminTest',$user->username);
        $this->assertTrue($user->roles->contains('id',1));
        $this->assertDatabaseHas('users',[
            'id' => $user->id,
            'email' => $user->email,
            'username' => 'adminTest',
        ]);
    }


    public function test_permitted_can_admin_delete_user()
    {

        $this->actingAsAdmin();
        $count = rand(1,3);
        $user = User::factory()
            ->hasRoles($count)
            ->create();
        $roles = $user->roles()->first();
       $response = $this->deleteJson(route('users.destroy',$user->id))
            ->assertOk();
            $response->assertJson([
                'status' => 'success',
                'message' => 'کاربر با موفقیت حذف شد.'
            ]);
        $this->assertDatabaseMissing('users',[
            'id' => $user->id,
        ]);
        $this->assertDatabaseMissing('role_user',[
            'role_id' => $roles->id,
            'user_id' => $user->id
        ]);
    }

    public function test_admin_can_manual_Verify_user()
    {
        $this->actingAsAdmin();

        $user = User::factory()
            ->unverified()
            ->create();
        $response = $this->patch(route('users.manualVerify',$user->id))
            ->assertOk();
        $response->assertJson([
                'status' => 'success',
                'message' => 'کاربر با موفقیت تایید شد.'
        ]);
        $this->assertDatabaseHas('users',[
            'id'=>$user->id,
        ]);
        $this->assertNotNull(User::find($user->id)->email_verified_at);
    }

    public function test_non_admin_cannot_manual_verify_user()
    {
        $user = User::factory()->create(['email_verified_at'=>null]);
        $normalUser = User::factory()->create();
        $this->actingAs($normalUser);
       $response = $this->patch(route('users.manualVerify',$user->id));
       $response->assertForbidden();
    }

    public function test_user_can_see_their_own_profile()
    {
       $user = User::factory()->create();
       $this->actingAs($user);
       $this->get(route('users.profile'))
           ->assertOk()
           ->assertViewIs('User::Admin.profile')
           ->assertViewHas('user',function($viewUser) use ($user){
               return $viewUser->is($user);
           });
    }

    public function test_user_can_see_their_profile_edit_page()
    {
        $user =User::factory()->create();
        $this->actingAs($user);
        $this->get(route('users.editProfile',$user->id))
            ->assertOk()
            ->assertViewIs('User::Admin.editProfile')
            ->assertViewHas('user',function ($viewUser) use ($user){
                return $viewUser->is($user);
            });
    }

    public function test_user_can_update_their_profile()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $data = [
            'name' => 'alireza',
            'email' => 'alireza@mail.com',
            'username' =>'ali',
            'mobile' => '09123572258',
            'password' => 'Alireza123456@'
        ];
        $this->patch(route('users.updateProfile',$user->id),$data)
            ->assertRedirect(route('users.profile'));
        $user->refresh();
        $this->assertEquals($data['username'],$user->username);
        $this->assertEquals($data['name'],$user->name);
        $this->assertEquals($data['email'],$user->email);
        $this->assertDatabaseHas('users',[
            'id' => $user->id,
            'email' => $user->email,
            'mobile' => $user->mobile
        ]);
        $this->assertTrue(Hash::check($data['password'],$user->password));
    }


    private function createAndLoginUser()
    {
        $this->actingAs(User::factory()->create());
        $this->seed(RolePermissionSeeder::class);
    }

    private function actingAsAdmin()
    {
        $this->createAndLoginUser();
        $user = auth()->user();
       $user->givePermissionTo(Permission::PERMISSION_SUPER_ADMIN);

        $user->load('permissions');
    }

}
