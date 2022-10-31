<?php

namespace Tests\Feature\Loan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

class LoanTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // public function testShowLoans()
    // {
    //         Sanctum::actingAs(
    //         User::factory()->create(),
    //         ['view-loans']
    //         );

    //         $response = $this->getJson('/api/loans');

    //         $response->assertOk();


    //     // $response = $this->getJson('/api/loans');

    //     // $response->assertStatus(200)->assertJson([
    //     //     'created' => true,
    //     // ]);

    // }
}
