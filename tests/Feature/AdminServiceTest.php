<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\AdminService;
use App\Models\SpecialUser;
use App\Models\User;
use App\Models\Team;
use App\Models\Documents;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $adminService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminService = new AdminService();
    }

    /** @test */
    public function login_success_with_correct_credentials()
    {
        SpecialUser::create([
            'email' => 'admin@example.com',
            'password' => password_hash('Admin@123', PASSWORD_DEFAULT)
        ]);

        $request = Request::create('/admin/login', 'POST', [
            'email' => 'admin@example.com',
            'password' => 'Admin@123'
        ]);

        $response = $this->adminService->loginService($request);

        $this->assertEquals(200, $response['httpCode']);
        $this->assertEquals('Login Admin Berhasil', $response['message']);
        $this->assertTrue(session()->has('special_user'));
    }

    /** @test */
    public function login_fails_with_wrong_password_or_not_found()
    {
        SpecialUser::create([
            'email' => 'admin@example.com',
            'password' => password_hash('Admin@123', PASSWORD_DEFAULT)
        ]);

        $request1 = Request::create('/admin/login', 'POST', ['email' => 'admin@example.com', 'password' => 'Salah123']);
        $response1 = $this->adminService->loginService($request1);
        $this->assertEquals(401, $response1['httpCode']);

        $request2 = Request::create('/admin/login', 'POST', ['email' => 'ghost@example.com', 'password' => 'Admin@123']);
        $response2 = $this->adminService->loginService($request2);
        $this->assertEquals(402, $response2['httpCode']);
    }

    /** @test */
    public function get_info_team_returns_correct_statistics()
    {
        $user = User::factory()->create();

        $team1 = Team::create(['user_id' => $user->id, 'team_name' => 'Tim 1', 'institution' => '-', 'advisor_name' => '-', 'advisor_phone' => '-', 'status_team' => 0]);
        $team2 = Team::create(['user_id' => $user->id, 'team_name' => 'Tim 2', 'institution' => '-', 'advisor_name' => '-', 'advisor_phone' => '-', 'status_team' => 0]);
        $team3 = Team::create(['user_id' => $user->id, 'team_name' => 'Tim 3', 'institution' => '-', 'advisor_name' => '-', 'advisor_phone' => '-', 'status_team' => 0]);

        // ✅ PERBAIKAN: Menambahkan 'has_payed' => false
        Documents::create(['team_id' => $team1->id, 'status_document' => 'pending', 'document_path' => 'dummy.pdf', 'has_payed' => false]);
        Documents::create(['team_id' => $team2->id, 'status_document' => 'approved', 'document_path' => 'dummy.pdf', 'has_payed' => false]);
        Documents::create(['team_id' => $team3->id, 'status_document' => 'pending', 'document_path' => 'dummy.pdf', 'has_payed' => false]);

        $result = $this->adminService->GetInfoTeam();

        $this->assertEquals(3, $result['total']);
        $this->assertEquals(2, $result['pending']);
        $this->assertEquals(1, $result['approved']);
        $this->assertEquals(0, $result['rejected']);
    }

    /** @test */
    public function accepted_updates_document_and_team_status()
    {
        $user = User::factory()->create();
        $team = Team::create(['user_id' => $user->id, 'team_name' => 'Tim A', 'institution' => '-', 'advisor_name' => '-', 'advisor_phone' => '-', 'status_team' => false]);

        // ✅ PERBAIKAN: Menambahkan 'has_payed' => false
        Documents::create(['team_id' => $team->id, 'status_document' => 'pending', 'document_path' => 'dummy.pdf', 'has_payed' => false]);

        $request = Request::create('/admin/accepted', 'POST', ['team_id' => $team->id]);
        $response = $this->adminService->Accepted($request);

        $this->assertEquals(200, $response['httpCode']);
        $this->assertDatabaseHas('documents', ['team_id' => $team->id, 'status_document' => 'approved']);
        $this->assertDatabaseHas('teams', ['id' => $team->id, 'status_team' => true]);
    }

    /** @test */
    public function rejected_updates_status_and_deletes_file()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $team = Team::create(['user_id' => $user->id, 'team_name' => 'Tim B', 'institution' => '-', 'advisor_name' => '-', 'advisor_phone' => '-', 'status_team' => true]);

        $filePath = 'documents/proposal_tim_b.pdf';
        Storage::disk('public')->put($filePath, 'dummy content');

        Documents::create([
            'team_id' => $team->id,
            'status_document' => 'pending',
            'document_path' => $filePath,
            'has_payed' => true // Simulasi sudah bayar
        ]);

        $request = Request::create('/admin/rejected', 'POST', [
            'team_id' => $team->id,
            'alasan_penolakan' => 'Dokumen buram'
        ]);

        $response = $this->adminService->Rejected($request);

        // ✅ PERBAIKAN: Memastikan error log dapat ditangkap jika statusnya bukan 200
        $this->assertEquals(200, $response['httpCode'], "Gagal melakukan reject. Pesan: " . ($response['message'] ?? ''));

        $this->assertDatabaseHas('documents', [
            'team_id' => $team->id,
            'status_document' => 'rejected',
            'alasan_ditolak' => 'Dokumen buram',
            'has_payed' => false,
            'document_path' => ''
        ]);
        $this->assertDatabaseHas('teams', ['id' => $team->id, 'status_team' => false]);

        Storage::disk('public')->assertMissing($filePath);
    }

    /** @test */
    public function delete_team_removes_records_and_file()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $team = Team::create(['user_id' => $user->id, 'team_name' => 'Tim C', 'institution' => '-', 'advisor_name' => '-', 'advisor_phone' => '-', 'status_team' => false]);

        $filePath = 'documents/to_be_deleted.pdf';
        Storage::disk('public')->put($filePath, 'dummy content');

        // ✅ PERBAIKAN: Menambahkan 'has_payed' => false
        Documents::create([
            'team_id' => $team->id,
            'document_path' => $filePath,
            'has_payed' => false,
            'status_document' => 'pending' // <--- Tambahkan ini
        ]);

        $response = $this->adminService->DeleteTeam($team->id);

        $this->assertEquals(200, $response['httpCode']);
        $this->assertDatabaseMissing('teams', ['id' => $team->id]);
        $this->assertDatabaseMissing('documents', ['team_id' => $team->id]);
        Storage::disk('public')->assertMissing($filePath);
    }

    /** @test */
    public function get_list_karya_returns_teams_with_links_only()
    {
        $user = User::factory()->create();
        Team::create(['user_id' => $user->id, 'team_name' => 'Tim Link', 'institution' => '-', 'advisor_name' => '-', 'advisor_phone' => '-', 'status_team' => 1, 'link_karya' => 'https://github.com/a']);
        Team::create(['user_id' => $user->id, 'team_name' => 'Tim No Link', 'institution' => '-', 'advisor_name' => '-', 'advisor_phone' => '-', 'status_team' => 1, 'link_karya' => null]);

        $result = $this->adminService->GetListKarya();

        $this->assertCount(1, $result);
        $this->assertEquals('Tim Link', $result[0]->team_name);
    }
}