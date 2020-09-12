<?php
require_once "services/handle_capitalise_surname.php";
use PHPUnit\Framework\TestCase;

class HandleCapitaliseSurnameTest extends TestCase {
    /**
     * Test Handle Capitalise Surname for "Mc" surnames
     * @test
     */
    public function test_capitalise_surname_mc() {
        $this->assertEquals("McDonalds", handle_capitalise_surname("mcdonalds"));
    }

    /**
     * Test Handle Capitalise Surname for "O'" surnames
     * @test
     */
    public function test_capitalise_surname_o() {
        $this->assertEquals("O'Reilly", handle_capitalise_surname("o'reilly"));
    }

    /**
     * Test Handle Capitalise Surname for normal surnames
     * @test
     */
    public function test_capitalise_surname() {
        $this->assertEquals("Smith", handle_capitalise_surname("smith"));
    }
}