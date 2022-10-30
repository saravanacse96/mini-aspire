<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
                $password = 'sample_user';
                $user_type = 'Admin';
                $response = $this->postJson('/api/auth/register', [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'password_confirmation' => $password,
                    'user_type' => $user_type,
                ]);
                 // dd($response);

            $response->assertStatus(200)->assertJson([
             'created' => true,
            ]);

            // $this->assertTrue($response['created']);

            // $response = $this->postJson('/api/loan-approve',[
            //     'loan_id' => 3,
            //     'status' =>'APPROVED'
            // ]);
            // dd($response);
        }

        public function testLoginUser()
        {
             $this->withoutExceptionHandling();
                // $email = $this->faker->safeEmail;
                // $password = $this->faker->password(8);
                $response = $this->postJson('/api/auth/login', [
                    'email' => 'sample_user@gmail.com',
                    'password' => 'sample_user'
                ]);

                $response->assertStatus(200)->assertJson([
                    'created' => true,
                ]);
                $this->assertTrue($response['created']);

            // $response = $this->postJson('/api/loan-approve',[
            //     'loan_id' => 3,
            //     'status' =>'APPROVED'
            // ]);
            // dd($response);
        }

   
}
