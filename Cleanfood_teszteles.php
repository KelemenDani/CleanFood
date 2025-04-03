<?php

use PHPUnit\Framework\TestCase;

class KosarTeszt extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION = [];
    }

    private function mockInput(array $data): void
    {
        file_put_contents('php://input', json_encode($data));
    }

    public function testUjTermekHozzaadasa()
    {
        $_SESSION['user'] = 'testuser';
        $data = [
            'name' => 'Saláta',
            'price' => 1500,
            'quantity' => 1
        ];
        
        $this->mockInput($data);

        ob_start();
        include 'add_to_cart.php';
        $output = ob_get_clean();

        $response = json_decode($output, true);
        $this->assertTrue($response['success']);
        $this->assertArrayHasKey('Saláta', $_SESSION['cart']);
        $this->assertEquals(1500, $_SESSION['cart']['Saláta']['price']);
        $this->assertEquals(1, $_SESSION['cart']['Saláta']['quantity']);
    }

    public function testTermekMennyisegNovelese()
    {
        $_SESSION['user'] = 'testuser';
        $_SESSION['cart'] = [
            'Saláta' => [
                'name' => 'Saláta',
                'price' => 1500,
                'quantity' => 1
            ]
        ];

        $data = [
            'name' => 'Saláta',
            'price' => 1500,
            'quantity' => 2
        ];
        
        $this->mockInput($data);

        ob_start();
        include 'add_to_cart.php';
        $output = ob_get_clean();

        $response = json_decode($output, true);
        $this->assertTrue($response['success']);
        $this->assertEquals(3, $_SESSION['cart']['Saláta']['quantity']);
    }

    public function testBejelentkezesNelkul()
    {
        $data = [
            'name' => 'Saláta',
            'price' => 1500,
            'quantity' => 1
        ];
        
        $this->mockInput($data);

        ob_start();
        include 'add_to_cart.php';
        $output = ob_get_clean();

        $response = json_decode($output, true);
        $this->assertFalse($response['success']);
        $this->assertEquals('Nincs bejelentkezve', $response['message']);
    }
}

?>