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

    /**
     * Test admin and staff can access Aset Tetap list.
     */
    public function test_admin_and_staff_can_access_aset_tetap_list(): void
    {
        $response = $this->actingAs($this->admin)->get('/aset-tetap');
        $response->assertStatus(200);

        $response = $this->actingAs($this->staff)->get('/aset-tetap');
        $response->assertStatus(200);
    }

    /**
     * Test pimpinan can view Aset Tetap list (read-only).
     */
    public function test_pimpinan_can_view_aset_tetap_list(): void
    {
        $response = $this->actingAs($this->pimpinan)->get('/aset-tetap');
        $response->assertStatus(200);
    }

    /**
     * Test pimpinan cannot access Aset Tetap creation form.
     */
    public function test_pimpinan_cannot_access_aset_tetap_creation_form(): void
    {
        $response = $this->actingAs($this->pimpinan)->get('/aset-tetap/create/form');
        $response->assertStatus(403);
    }

    /**
     * Test admin can create Aset Tetap.
     */
    public function test_admin_can_create_aset_tetap(): void
    {
        $response = $this->actingAs($this->admin)->post('/aset-tetap', [
            'nama_aset' => 'Ruko Test',
            'tipe' => 'ruko',
            'alamat' => 'Alamat Ruko Test',
            'luas_tanah' => 100,
            'luas_bangunan' => 150,
            'tanggal_perolehan' => '2026-07-19',
            'nilai_perolehan' => 100000000.00,
            'status_kepemilikan' => 'milik_sendiri',
            'kondisi_bangunan' => 'baik',
            'pic' => 'PIC Test',
            'keterangan' => 'Keterangan Test',
        ]);

        $response->assertRedirect('/aset-tetap');
        $this->assertDatabaseHas('aset_tetaps', [
            'nama_aset' => 'Ruko Test',
            'tipe' => 'ruko',
        ]);
    }
}
