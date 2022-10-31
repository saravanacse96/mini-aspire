<?php

namespace Tests\Unit\Loan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
// use PHPUnit\Framework\TestCase;
use App\Models\User;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class LoanTest extends TestCase
{
     use RefreshDatabase;
     protected $user;
    
    public function setUp():void
    {
        parent::setUp();
         $user=$this->authUser();
         // dd($this->authUser());
    }
    public function testCreateLoan()
    {
        // $this->withoutExceptionHandling();

        // $user = User::factory()->create();
        // Sanctum::actingAs($user,['*']);
        // $this->authUser();
        Sanctum::actingAs($this->user,['*']);
        
        $formData=[
        'loan_amount' => 10.000,
        'no_of_terms' => 3
        ];
        $response = $this->postJson('/api/create/loan-request', $formData);
        // dd($response);

        $response->assertStatus(200)->assertJson([
        'created' => true,
        ]);

    }

    public function testShowLoans()
    {
        // $this->withoutExceptionHandling();

        // $user = User::factory()->create();
        // Sanctum::actingAs($user);
        // $this->actingAs($user,'api');

        // Sanctum::actingAs(
        // User::factory()->create(),
        //     ['*']
        // );
         // $this->authUser();
        $response = $this->getJson('/api/loans');
        // dd($response);

        $response->assertStatus(200)->assertJson([
        'created' => true,
        ]);

    }
}
