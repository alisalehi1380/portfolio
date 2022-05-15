<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WriterTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * ادمین به روت دسترسی داشته باشه
     *
     * @return void
     */
    public function test_admin_can_see_create_writer_form()
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin);

        $respo = $this->get(route('new.writer.admin'));

        $respo->assertOk();

    }

    /**
     * غیر ادمین به روت دسترسی نداشته باشه
     */
    public function test_only_admin_able_to_see_create_wirter_form()
    {
        $this->makeUser();

        $response = $this->get(route('new.writer.admin'));

        $response->assertForbidden();
    }

    /**
     * تست خطای ولیدیشن
     */
    public function test_create_writer_validation_error()
    {
        $this->makeAdmin();

        $this->post(route('store.writer.admin'))
            ->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /**
     * ساخت یک نویسنده جدید توسط ادمین
     */
    public function test_create_new_writer()
    {
        $this->makeAdmin();

        $data = [
            'name'                  => 'abbas',
            'email'                 => 'adminali@ab.cc',
            'password'              => '12345',
            'password_confirmation' => '12345'

        ];

        $res = $this->post(route('store.writer.admin'), $data);

        $this->assertDatabaseHas('users', [
            'name'  => 'abbas',
            'email' => 'adminali@ab.cc',
            'type'  => 'writer'
        ]);

        $res->assertRedirect(route('new.writer.admin'))
            ->assertSessionHas('success', 'new Writer Created Successfully');

    }

    /**
     * لاگین یک یوزر ساده
     */
    private function makeUser(): void
    {
        //normall user
        $user = User::factory()->user()->create();
        //login
        $this->actingAs($user);
    }

    /**
     * لاگین یک ادمین
     */
    private function makeAdmin(): void
    {
        // admin user
        $user = User::factory()->admin()->create();
        //login
        $this->actingAs($user);
    }
}
