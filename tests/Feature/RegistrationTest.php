<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class RegistrationFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_new_user_and_displays_success_message()
    {
        $response = $this->post('/register', [
            'full_name' => 'Jane Doe',
            'user_name' => 'janedoe',
            'birthdate' => '2000-01-01',
            'phone' => '123-456-7890',
            'address' => '123 Main St',
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => 'jane@example.com',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Registration successful!']);
        $this->assertDatabaseHas('users', [
            'email' => 'jane@example.com',
        ]);
    }
}
