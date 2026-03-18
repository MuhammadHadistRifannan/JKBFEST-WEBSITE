<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\UserService;
use App\Models\User;
use App\Models\EmailVerification;
use App\Models\ResetToken;
use App\Mail\SendOtpMail;
use App\Mail\SendResetMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
        
        // Clear rate limiter sebelum setiap test agar test tidak saling bentrok
        RateLimiter::clear('test@example.com');
        RateLimiter::clear('reset@example.com');
        RateLimiter::clear('update@example.com');
    }

    /** @test */
    public function login_success_with_correct_credentials()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('Password@123')
        ]);

        $request = Request::create('/login', 'POST', [
            'email' => 'test@example.com',
            'password' => 'Password@123'
        ]);

        $response = $this->userService->loginService($request);

        $this->assertEquals(200, $response['httpCode']); 
        $this->assertEquals('login success', $response['message']);
    }

    /** @test */
    public function register_sends_otp_and_saves_to_db()
    {
        Mail::fake();

        $request = Request::create('/register', 'POST', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'no_telepon' => '08123456789',
            'password' => 'Password@123'
        ]);

        $response = $this->userService->registerService($request);

        $this->assertEquals(200, $response['httpCode']);
        $this->assertDatabaseHas('email_verifications', [
            'email' => 'test@example.com'
        ]);

        Mail::assertSent(SendOtpMail::class);
    }

    /** @test */
    public function regist_user_success_with_valid_otp()
    {
        EmailVerification::create([
            'email' => 'test@example.com',
            'otp' => '123456',
            'expired_at' => now()->addMinutes(5),
            'verified' => false
        ]);

        $request = Request::create('/regist-user', 'POST', [
            'name' => 'Valid User',
            'email' => 'test@example.com',
            'no_telepon' => '08123456789',
            'password' => 'Password@123',
            'otp' => ['1', '2', '3', '4', '5', '6']
        ]);

        $response = $this->userService->registUser($request);

        $this->assertEquals(200, $response['httpCode']);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        $this->assertDatabaseHas('email_verifications', ['email' => 'test@example.com', 'verified' => true]);
    }

    /** @test */
    public function update_service_successfully_updates_user_profile()
    {
        // 1. Setup user asli di database
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
            'no_telp' => '08111111111'
        ]);

        // 2. Simulasikan user sedang login
        $this->actingAs($user); 

        // 3. Buat request dengan data baru
        $request = Request::create('/update-profile', 'POST', [
            'name' => 'New Name',
            'email' => 'update@example.com',
            'phone' => '08222222222'
        ]);

        $response = $this->userService->updateService($request);

        // 4. Pastikan response sukses dan database berubah
        $this->assertEquals(200, $response['httpCode']);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
            'email' => 'update@example.com',
            'no_telp' => '08222222222'
        ]);
    }

    /** @test */
    public function send_reset_password_queues_email_and_saves_token()
    {
        Mail::fake();
        User::factory()->create(['email' => 'reset@example.com']);

        $request = Request::create('/send-reset', 'POST', [
            'email' => 'reset@example.com'
        ]);

        $response = $this->userService->SendResetPassword($request);

        $this->assertEquals(200, $response['httpCode']);
        $this->assertDatabaseHas('token_reset_password', ['email' => 'reset@example.com']);
        Mail::assertSent(SendResetMail::class);
    }

    /** @test */
    public function reset_password_updates_password_and_deletes_token()
    {
        $user = User::factory()->create([
            'email' => 'reset@example.com',
            'password' => Hash::make('OldPassword@123')
        ]);

        ResetToken::create([
            'email' => 'reset@example.com',
            'token' => 'valid-reset-token-123'
        ]);

        $request = Request::create('/reset-password', 'POST', [
            'email' => 'reset@example.com',
            'password' => 'NewPassword@123',
            'password_confirmation' => 'NewPassword@123',
            'token' => 'valid-reset-token-123'
        ]);

        $response = $this->userService->ResetPassword($request);

        $this->assertEquals(200, $response['httpCode']);
        
        // Pastikan token dihapus setelah reset berhasil
        $this->assertDatabaseMissing('token_reset_password', ['token' => 'valid-reset-token-123']);

        // Pastikan password benar-benar berubah di database
        $user->refresh();
        $this->assertTrue(Hash::check('NewPassword@123', $user->password));
    }

    /** @test */
    public function resend_otp_successfully_sends_email_and_updates_db()
    {
        Mail::fake();

        $request = Request::create('/resend-otp', 'POST', [
            'email' => 'test@example.com'
        ]);

        $response = $this->userService->ResendOtp($request);

        $this->assertEquals(200, $response['httpCode']);
        $this->assertDatabaseHas('email_verifications', ['email' => 'test@example.com']);
        Mail::assertSent(SendOtpMail::class);
    }
}