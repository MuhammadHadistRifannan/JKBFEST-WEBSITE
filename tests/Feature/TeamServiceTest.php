<?php

namespace Tests\Unit\Services;

use App\Models\Documents;
use Tests\TestCase;
use App\Services\TeamService;
use App\Models\User;
use App\Models\Team;
use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TeamServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $teamService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->teamService = new TeamService();
    }

    /** @test */
    public function register_team_success_with_one_member()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $request = Request::create('/register-team', 'POST', [
            'team_name' => 'Tim Hebat',
            'institution' => 'Universitas Keren',
            'advisor_name' => 'Dr. Pembimbing',
            'advisor_phone' => '081234567890',
            'member_1_name' => 'Anggota Satu',
            'member_1_phone' => '08111111111',
            'member_2_name' => '', // Anggota 2 kosong
            'member_2_phone' => ''
        ]);

        $response = $this->teamService->RegisterTeam($request);

        $this->assertEquals(200, $response['httpCode']); // Sesuaikan nama key dengan format ResponseService kamu
        $this->assertDatabaseHas('teams', [
            'user_id' => $user->id,
            'team_name' => 'Tim Hebat'
        ]);
        
        // Cek bahwa member 1 masuk, tapi member 2 tidak (karena kosong)
        $this->assertDatabaseCount('team_members', 1);
        $this->assertDatabaseHas('team_members', [
            'name' => 'Anggota Satu'
        ]);
    }

    /** @test */
    public function upload_document_fails_if_not_pdf()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('public');
        
        // Simulasi upload file gambar (bukan PDF)
        $file = UploadedFile::fake()->image('dokumen.jpg');

        $request = Request::create('/upload-document', 'POST');
        $request->files->set('document_file', $file);

        $response = $this->teamService->UploadDocument($request);

        $this->assertEquals(422, $response['httpCode']);
        $this->assertStringContainsString('Validasi gagal', $response['message']);
    }

    /** @test */
    public function upload_document_success_creates_new_document()
    {
        $user = User::factory()->create();
        $team = Team::create([
            'user_id' => $user->id,
            'team_name' => 'Tim Hebat',
            'institution' => 'Kampus',
            'advisor_name' => 'Dosen',
            'advisor_phone' => '0812',
            'status_team' => false,
            'status_document' => false,
        ]);

        $this->actingAs($user);
        Storage::fake('public');

        // Simulasi file PDF ukuran 1MB
        $file = UploadedFile::fake()->create('dokumen_proposal.pdf', 1000, 'application/pdf');

        $request = Request::create('/upload-document', 'POST');
        $request->files->set('document_file', $file);

        $response = $this->teamService->UploadDocument($request);

        $this->assertEquals(200, $response['httpCode']);
        
        // Pastikan path file ada di dalam database
        $this->assertDatabaseHas('documents', [
            'team_id' => $team->id,
            'status_document' => 'pending'
        ]);

        // Pastikan file benar-benar "ter-upload" ke storage virtual
        Storage::disk('public')->assertExists($response['data']['file_path']);
    }

    /** @test */
    public function has_payment_fails_if_document_not_uploaded()
    {
        $user = User::factory()->create();
        $team = Team::create([
            'user_id' => $user->id,
            'team_name' => 'Tim Pembayar',
            'institution' => '-', 'advisor_name' => '-', 'advisor_phone' => '-', 'status_team' => 0, 'status_document' => 0
        ]);
        $this->actingAs($user);

        // Langsung panggil fungsi tanpa membuat record document sebelumnya
        $response = $this->teamService->HasPayment();

        $this->assertEquals(401, $response['httpCode']);
        $this->assertStringContainsString('Upload dokumen team terlebih dahulu', $response['message']);
    }

    /** @test */
    public function has_payment_success_updates_status()
    {
        $user = User::factory()->create();
        $team = Team::create([
            'user_id' => $user->id,
            'team_name' => 'Tim Pembayar',
            'institution' => '-', 'advisor_name' => '-', 'advisor_phone' => '-', 'status_team' => 0, 'status_document' => 0
        ]);
        
        $document = Documents::create([
            'team_id' => $team->id,
            'document_path' => 'documents/fake.pdf',
            'status_document' => 'pending',
            'has_payed' => false
        ]);

        $this->actingAs($user);

        $response = $this->teamService->HasPayment();

        $this->assertEquals(200, $response['httpCode']);
        $this->assertDatabaseHas('documents', [
            'id' => $document->id,
            'has_payed' => true
        ]);
    }

    /** @test */
    public function upload_karya_success_updates_link_and_time()
    {
        $user = User::factory()->create();
        $team = Team::create([
            'user_id' => $user->id,
            'team_name' => 'Tim Karya',
            'institution' => '-', 'advisor_name' => '-', 'advisor_phone' => '-', 'status_team' => 0, 'status_document' => 0
        ]);
        $this->actingAs($user);

        $request = Request::create('/upload-karya', 'POST', [
            'link_karya' => 'https://github.com/my-project'
        ]);

        $response = $this->teamService->UploadKarya($request);

        $this->assertEquals(200, $response['httpCode']);
        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'link_karya' => 'https://github.com/my-project'
        ]);
        
        // Memastikan kolom waktu_submit terisi (tidak null)
        $updatedTeam = Team::find($team->id);
        $this->assertNotNull($updatedTeam->waktu_submit);
    }
}