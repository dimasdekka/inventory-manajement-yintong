<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed basic users
        $this->admin = User::create([
            'nama' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'role' => 'administrator',
            'status' => 'aktif',
        ]);

        $this->staff = User::create([
            'nama' => 'Staff Test',
            'email' => 'staff@test.com',
            'password' => bcrypt('password123'),
            'role' => 'staff_gudang',
            'status' => 'aktif',
        ]);

        $this->pimpinan = User::create([
            'nama' => 'Pimpinan Test',
            'email' => 'pimpinan@test.com',
            'password' => bcrypt('password123'),
            'role' => 'pimpinan',
            'status' => 'aktif',
        ]);

        $this->nonaktif = User::create([
            'nama' => 'Nonaktif Test',
            'email' => 'nonaktif@test.com',
            'password' => bcrypt('password123'),
            'role' => 'staff_gudang',
            'status' => 'nonaktif',
        ]);
    }

    /**
     * Test guest can see login page.
     */
    public function test_guest_can_see_login_page(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Yintong Inventory');
    }

    /**
     * Test user login with correct credentials.
     */
    public function test_user_can_login_with_correct_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($this->admin);
    }

    /**
     * Test user login with incorrect credentials.
     */
    public function test_user_cannot_login_with_incorrect_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test nonactive user cannot login.
     */
    public function test_nonactive_user_cannot_login(): void
    {
        $response = $this->post('/login', [
            'email' => 'nonaktif@test.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test admin can access users page.
     */
    public function test_admin_can_access_users_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/users');
        $response->assertStatus(200);
    }

    /**
     * Test staff cannot access users page.
     */
    public function test_staff_cannot_access_users_page(): void
    {
        $response = $this->actingAs($this->staff)->get('/users');
        $response->assertStatus(403);
    }

    /**
     * Test pimpinan cannot access users page.
     */
    public function test_pimpinan_cannot_access_users_page(): void
    {
        $response = $this->actingAs($this->pimpinan)->get('/users');
        $response->assertStatus(403);
    }

    /**
     * Test pimpinan cannot record transactions.
     */
    public function test_pimpinan_cannot_record_transactions(): void
    {
        $response = $this->actingAs($this->pimpinan)->get('/barang-masuk/create/form');
        $response->assertStatus(403);
    }

}
