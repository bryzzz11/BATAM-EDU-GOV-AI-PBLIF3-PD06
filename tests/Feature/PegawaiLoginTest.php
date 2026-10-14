<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PegawaiLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_pegawai_login_page_has_no_google_login(): void
    {
        $this->get(route('pegawai.login'))
            ->assertOk()
            ->assertSee('ID ASN')
            ->assertDontSee('Google');
    }

    public function test_pegawai_can_sign_in_with_employee_id_and_assigned_role(): void
    {
        $pegawai = User::factory()->create();
        $pegawai->forceFill([
            'employee_id' => 'ASN-12345',
            'role' => 'verifikator',
        ])->save();

        $response = $this->post(route('pegawai.login.submit'), [
            'identifier' => 'ASN-12345',
            'password' => 'password',
            'role' => 'verifikator',
        ]);

        $response->assertRedirect(route('pegawai.dashboard'));
        $this->assertAuthenticatedAs($pegawai);
        $this->get(route('pegawai.dashboard'))->assertOk();
    }

    public function test_pegawai_cannot_sign_in_using_another_role(): void
    {
        $pegawai = User::factory()->create();
        $pegawai->forceFill(['role' => 'admin'])->save();

        $this->from(route('pegawai.login'))
            ->post(route('pegawai.login.submit'), [
                'identifier' => $pegawai->email,
                'password' => 'password',
                'role' => 'pimpinan',
            ])
            ->assertRedirect(route('pegawai.login'))
            ->assertSessionHasErrors('identifier');

        $this->assertGuest();
    }

    public function test_pemohon_cannot_access_pegawai_dashboard(): void
    {
        $pemohon = User::factory()->create();

        $this->actingAs($pemohon)
            ->get(route('pegawai.dashboard'))
            ->assertForbidden();
    }

    public function test_pegawai_cannot_sign_in_through_public_login(): void
    {
        $pegawai = User::factory()->create();
        $pegawai->forceFill(['role' => 'admin'])->save();

        $this->from(route('login'))
            ->post(route('login'), [
                'email' => $pegawai->email,
                'password' => 'password',
            ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}
