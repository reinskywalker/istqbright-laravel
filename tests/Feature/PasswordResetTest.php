<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Laravel\Fortify\Features;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_renderPasswordLink()
    {
        if (!Features::enabled(Features::updatePasswords())) {
            return $this->markTestSkipped('Password updates are not enabled.');
        }

        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_requestPasswordUrl()
    {
        if (!Features::enabled(Features::updatePasswords())) {
            return $this->markTestSkipped('Password updates are not enabled.');
        }

        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_renderResetPassword()
    {
        if (!Features::enabled(Features::updatePasswords())) {
            return $this->markTestSkipped('Password updates are not enabled.');
        }

        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $response = $this->get('/reset-password/' . $notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_resetValidPassword()
    {
        if (!Features::enabled(Features::updatePasswords())) {
            return $this->markTestSkipped('Password updates are not enabled.');
        }

        Notification::fake();

        $user = User::factory()->create();

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $user->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}
