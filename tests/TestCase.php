<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function createUser($args = []){

        return User::factory()->create($args);
    }

    public function authUser($args = []){

        $user=$this->createUser();
        Sanctum::actingAs($user);
        return  $user;
    }

}
