<?php

namespace Tests\Feature;

use App\Models\ResetToken;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function public_beranda_returns_200()
    {
        // Menguji rute '/'
        $response = $this->get(route('beranda'));
        $response->assertStatus(200);
    }

    /** @test */
    public function login_and_forgot_password_views_are_accessible()
    {
        // Menguji halaman auth publik
        $this->get(route('login.view'))->assertStatus(200);
        $this->get(route('password.request'))->assertStatus(200);
    }

    /** @test */
    public function admin_routes_are_protected_by_middleware()
    {
        // Mencoba akses dashboard admin TANPA login/session admin
        $response = $this->get(route('admin.dashboard'));

        // Ekspektasinya adalah di-redirect ke halaman login admin (status 302) 
        // atau diblokir (status 401/403) tergantung isi AdminMiddleware kamu.
        // Asumsi standar: redirect ke login
        $response->assertStatus(302);
    }

    /** @test */
    public function user_routes_are_protected_by_auth_middleware()
    {
        // Mencoba akses dashboard user TANPA login
        $response = $this->get(route('dashboard'));

        // Ekspektasinya di-redirect (biasanya ke login) karena AuthMiddleware
        $response->assertStatus(302);
    }

    /** @test */
    public function reset_password_with_invalid_token_redirects_to_login()
    {
        // Menguji rute GET /reset-password/{token} dengan token ngawur
        $response = $this->get(route('password.reset', ['token' => 'token-palsu-123']));

        // Sesuai kodemu: return redirect()->route('login');
        $response->assertRedirect(route('login.view')); 
        // Catatan: Pastikan nama route redirect di kodemu 'login' atau 'login.view' sesuai penamaanmu.
    }

    
    /** @test */
    public function admin_root_redirects_to_dashboard()
    {
        $response = $this->get('/admin');
        $response->assertRedirect(route('admin.dashboard'));
    }
}