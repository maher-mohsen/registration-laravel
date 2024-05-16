<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_full_name_is_required()
    {
        $response = $this->post('/register', [
            // 'full_name' => 'John Doe', // Commented to test validation
            'user_name' => 'johndoe',
            'birthdate' => '2000-01-01',
            'phone' => '123-456-7890',
            'address' => '123 Main St',
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('full_name');
    }

    /** @test */
    public function it_validates_email_is_unique()
    {
        User::create([
            'full_name' => 'John Doe',
            'user_name' => 'johndoe',
            'birthdate' => '2000-01-01',
            'phone' => '123-456-7890',
            'address' => '123 Main St',
            'password' => Hash::make('password'),
            'email' => 'john@example.com',
        ]);

        $response = $this->post('/register', [
            'full_name' => 'Jane Doe',
            'user_name' => 'janedoe',
            'birthdate' => '2000-01-01',
            'phone' => '123-456-7890',
            'address' => '123 Main St',
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_checks_password_confirmation()
    {
        $response = $this->post('/register', [
            'full_name' => 'Jane Doe',
            'user_name' => 'janedoe',
            'birthdate' => '2000-01-01',
            'phone' => '123-456-7890',
            'address' => '123 Main St',
            'password' => 'password',
            'password_confirmation' => 'differentpassword',
            'email' => 'jane@example.com',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function it_stores_user_data_in_database()
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

        $this->assertDatabaseHas('users', [
            'email' => 'jane@example.com',
        ]);
    }
}
