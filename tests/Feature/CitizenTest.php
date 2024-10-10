<?php

namespace Tests\Feature;

use App\Models\Citizen;
use Database\Seeders\CitizenSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class CitizenTest extends TestCase
{

    public function testSearchByNama()
    {
        $this->seed([UserSeeder::class, CitizenSeeder::class]);

        $response = $this->get('/api/citizens?search=john', [
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

        $response = $this->get('/api/citizens?search=35051803110', [
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

        $response = $this->get('/api/citizens?search=35051803110', [
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

        $response = $this->get('/api/citizens?search=tidakada', [
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

    public function testCreateCitizen()
    {
        $this->seed([UserSeeder::class]);

        $this->post('/api/citizens', [
            'nama' => 'Test',
            'nik' => 350518031100213,
            'no_kk' => 350518031100213,
            'foto_ktp' => 'xShuSSHGFOZNcijsa.png',
            'foto_kk' => 'xShuSSHGFOZNcij3a.png',
            'umur' => 22,
            'jenis_kelamin' => 'Laki-laki',
            'provinsi' => 'Jawa Barat',
            'kab_kota' => 'Bandung',
            'kecamatan' => 'Cikeas',
            'kelurahan' => 'Sukamaju',
            'alamat' => 'test',
            'rt' => '003',
            'rw' => '001',
            'b_penghasilan' => 1243998,
            's_penghasilan' => 1186398,
            'alasan' => 'alasan'
        ], [
            'Authorization' => 'Bearer test'
        ])->assertStatus(201)
            ->assertJson([
                "data" => [
                    'nama' => 'Test',
                    'nik' => 350518031100213,
                    'no_kk' => 350518031100213,
                    'foto_ktp' => 'xShuSSHGFOZNcijsa.png',
                    'foto_kk' => 'xShuSSHGFOZNcij3a.png',
                    'umur' => 22,
                    'jenis_kelamin' => 'Laki-laki',
                    'provinsi' => 'Jawa Barat',
                    'kab_kota' => 'Bandung',
                    'kecamatan' => 'Cikeas',
                    'kelurahan' => 'Sukamaju',
                    'alamat' => 'test',
                    'rt' => '003',
                    'rw' => '001',
                    'b_penghasilan' => 1243998,
                    's_penghasilan' => 1186398,
                    'alasan' => 'alasan'
                ]
            ]);
    }

    public function testUpdateCitizen()
    {
        $this->seed([CitizenSeeder::class, UserSeeder::class]);

        $citizen = Citizen::query()->limit(1)->first();

        $this->put('/api/citizens/' . $citizen->id, [
            'nama' => 'Test 2',
            'nik' => 350518031100288,
            'no_kk' => 350518031100288,
            'foto_ktp' => 'xShuSSHGFOZNcijsa.png',
            'foto_kk' => 'xShuSSHGFOZNcij3a.png',
            'umur' => 22,
            'jenis_kelamin' => 'Laki-laki',
            'provinsi' => 'Jawa Barat',
            'kab_kota' => 'Bandung',
            'kecamatan' => 'Cikeas',
            'kelurahan' => 'Sukamaju',
            'alamat' => 'test',
            'rt' => '003',
            'rw' => '001',
            'b_penghasilan' => 1243988,
            's_penghasilan' => 1186388,
            'alasan' => 'alasan'
        ], [
            'Authorization' => 'Bearer test'
        ])->assertStatus(200)
        ->assertJson([
            'data' => [
                'nama' => 'Test 2',
                'nik' => 350518031100288,
                'no_kk' => 350518031100288,
                'foto_ktp' => 'xShuSSHGFOZNcijsa.png',
                'foto_kk' => 'xShuSSHGFOZNcij3a.png',
                'umur' => 22,
                'jenis_kelamin' => 'Laki-laki',
                'provinsi' => 'Jawa Barat',
                'kab_kota' => 'Bandung',
                'kecamatan' => 'Cikeas',
                'kelurahan' => 'Sukamaju',
                'alamat' => 'test',
                'rt' => '003',
                'rw' => '001',
                'b_penghasilan' => 1243988,
                's_penghasilan' => 1186388,
                'alasan' => 'alasan'
            ]
        ]);
    }
}
