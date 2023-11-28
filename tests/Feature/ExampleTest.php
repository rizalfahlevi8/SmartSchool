<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_dashboard()
    {
       $response = $this->get('/dashboard');
       $response->assertStatus(302);
    }
    public function test_dataraport()
    {
       $response = $this->get('/data-raport');
       $response->assertStatus(302);
    }
    public function test_editpassword()
    {
       $response = $this->get('/editpassword');
       $response->assertStatus(302);
    }
    public function test_store_kelas()
    {
        $response = $this->post('/data-kelas-insert', [
            'namakelas' => "X MIPA 3",
            'guru_id' => "3"
        ]);
        $response->assertStatus(302);
    }
    public function test_store_mapel()
    {
        $response = $this->post('/data-mapel-insert', [
            'kodemapel' => "KMP005",
            'namamapel' => "IPS"
        ]);
        $response->assertStatus(302);
    }
    public function test_store_guru()
    {
        $response = $this->post('/data-guru-insert', [
            'NIP'           => "12345",
            'nama'          => "Ayunda Kusuma",
            'password'      => "12345",
            'jk'            => "perempuan",
            'agama'         => "islam",
            'notelp'        => "081234416938",
            'tempatlahir'   => "Jember",
            'tgllahir'      => "2002-04-12",
            'foto'          => "guru1.jpg",
            'alamat'        => "Jl.Puring no 123" 
            
        ]);
        $response->assertStatus(302);
    }
    public function test_update_guru()
    {
        $response = $this->put('/data-guru-update/{_id}', [
            'NIP'           => "12345",
            'nama'          => "Yunita Astri",
            'password'      => "78900",
            'jk'            => "perempuan",
            'agama'         => "islam",
            'notelp'        => "08177",
            'tempatlahir'   => "Surabaya",
            'tgllahir'      => "1990-10-22",
            'foto'          => "yunita.jpg",
            'alamat'        => "Jl.Mawar no 80",

            
        ]);
        $response->assertStatus(302);
    }
}
