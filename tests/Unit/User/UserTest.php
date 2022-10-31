<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */

        public function testRegisterUser()
        {
             $this->withoutExceptionHandling();

                /*$name = $this->faker->name;
                $email = $this->faker->safeEmail;
                $password = $this->faker->password(8);*/

                $name = 'sample_user';
                $email = 'sample_user@gmail.com';
                $password = 'password';
                $user_type = 'Admin';
                $response = $this->postJson('/api/auth/register', [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'password_confirmation' => $password,
                    'user_type' => $user_type,
                ]);
                
            $response->assertStatus(200)->assertJson([
                 'created' => true,
            ]);

        }

        public function testLoginUser()
        {
            $this->withoutExceptionHandling();

            $user = User::factory()->create();

            $response = $this->postJson('/api/auth/login', [
            'email' =>  $user->email,
            'password' => 'password'
            ]);
            $response->assertStatus(200)->assertJson([
                'created' => true,
            ]);
            $this->assertTrue($response['created']);
        }

   
}
