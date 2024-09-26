<?php

namespace Tests\Feature;

use Database\Seeders\CitizenSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class CitizenTest extends TestCase
{

    public function testSearchByNama()
    {
        $this->seed([UserSeeder::class, CitizenSeeder::class]);

        $response = $this->get('/api/citizens?nama=john', [
            'Authorization' => 'Bearer test'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));

        self::assertEquals(10, count($response['data']));
        self::assertEquals(20, $response['meta']['total']);
    }

    public function testSearchByNik()
    {
        $this->seed([UserSeeder::class, CitizenSeeder::class]);

        $response = $this->get('/api/citizens?nik=35051803110', [
            'Authorization' => 'Bearer test'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));

        self::assertEquals(10, count($response['data']));
        self::assertEquals(20, $response['meta']['total']);
    }

    public function testSearchByNoKk()
    {
        $this->seed([UserSeeder::class, CitizenSeeder::class]);

        $response = $this->get('/api/citizens?no_kk=35051803110', [
            'Authorization' => 'Bearer test'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));

        self::assertEquals(10, count($response['data']));
        self::assertEquals(20, $response['meta']['total']);
    }

    public function testSearchNotFound()
    {
        $this->seed([UserSeeder::class, CitizenSeeder::class]);

        $response = $this->get('/api/citizens?nama=tidakada', [
            'Authorization' => 'Bearer test'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));

        self::assertEquals(0, count($response['data']));
        self::assertEquals(0, $response['meta']['total']);
    }

    public function testSearchWithPage()
    {
        $this->seed([UserSeeder::class, CitizenSeeder::class]);

        $response = $this->get('/api/citizens?size=5&page=2', [
            'Authorization' => 'Bearer test'
        ])->assertStatus(200)
            ->json();

        Log::info(json_encode($response, JSON_PRETTY_PRINT));

        self::assertEquals(5, count($response['data']));
        self::assertEquals(20, $response['meta']['total']);
        self::assertEquals(2, $response['meta']['current_page']);
    }
}
