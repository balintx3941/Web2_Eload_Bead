<?php

namespace Tests\Unit;

use App\Services\CalculatorService;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private CalculatorService $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = new CalculatorService();
    }

    public function test_osszeadas_helyes(): void
    {
        $result = $this->calculator->calculate(12, 8, '+');
        $this->assertEquals(20, $result);
    }

    public function test_kivonas_helyes(): void
    {
        $result = $this->calculator->calculate(25, 10, '-');
        $this->assertEquals(15, $result);
    }

    public function test_szorzas_helyes(): void
    {
        $result = $this->calculator->calculate(6, 7, '*');
        $this->assertEquals(42, $result);
    }

    public function test_osztas_helyes(): void
    {
        $result = $this->calculator->calculate(50, 5, '/');
        $this->assertEquals(10, $result);
    }

    public function test_nullaval_osztas_kivetelt_dob(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Nullával való osztás nem értelmezett.');

        $this->calculator->calculate(10, 0, '/');
    }
}