<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testUserCanRegister()
    {
        $response = $this->post('/register', [
            'full_name' => 'John Doe', // Commented to test validation
            'user_name' => 'johndoe',
            'birthdate' => '2000-01-01',
            'phone' => '01287695176',
            'address' => '123 Main St',
            'password' => 'password@123',
            'password_confirmation' => 'password@123',
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(302); // Redirected after successful registration
        $response->assertSessionDoesntHaveErrors(); // No validation errors
    }
}
