<?php
require_once "services/handle_sanitise_name.php";
use PHPUnit\Framework\TestCase;

class HandleSanitiseNameTest extends TestCase {
    /**
     * Test Handle sanitising normal surname
     * @test
     */
    public function test_sanitise_normal_surname() {
        $this->assertEquals("Smith", handle_sanitise_name("      smith         ", true));
    }

    /**
     * Test Handle sanitising normal name
     * @test
     */
    public function test_sanitise_normal_name() {
        $this->assertEquals("Adam", handle_sanitise_name("      Adam         ", false));
    }

    /**
     * Test Handle sanitising multiple surname
     * @test
     */
    public function test_sanitise_multiple_surname() {
        $this->assertEquals("La Canna", handle_sanitise_name(" la canna     ", true));
    }
}