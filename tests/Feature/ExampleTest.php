<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * 简单的功能测试用例
     *
     * @return void
     */
    // public function testBasicExample()
    // {
    //     $response = $this->withHeaders([
    //         'X-Header'=>'LaravelAcaemy',
    //         ])->json('POST','user',['name' => '学院君']);

    //     $response
    //         ->assertStatus(200)
    //         ->assertJson([
    //             'created' => true,
    //         ]);
    // }

    
}
