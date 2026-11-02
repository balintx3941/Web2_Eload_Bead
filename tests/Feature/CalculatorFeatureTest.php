<?php

namespace Tests\Feature;

use Tests\TestCase;

class CalculatorFeatureTest extends TestCase
{
    public function test_szamologep_oldal_betolt(): void
    {
        $response = $this->get('/teszt');

        $response->assertStatus(200);
        $response->assertSee('Számológép');
    }

    public function test_sikeres_szamitas(): void
    {
        $response = $this->post('/teszt', [
            'a' => 15,
            'operation' => '+',
            'b' => 35,
        ]);

        $response->assertSessionHas('result', 50);
        $response->assertSessionHasNoErrors();
    }

    public function test_validacios_hiba_hianyzo_ertekeknel(): void
    {
        $response = $this->post('/teszt', [
            'a' => '',
            'operation' => '+',
            'b' => '',
        ]);

        $response->assertSessionHasErrors(['a', 'b']);
    }

    public function test_nullaval_osztas_hibauzenetet_ad(): void
    {
        $response = $this->post('/teszt', [
            'a' => 10,
            'operation' => '/',
            'b' => 0,
        ]);

        $response->assertSessionHasErrors(['b']);
    }
}