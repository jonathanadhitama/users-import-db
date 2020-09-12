<?php
require_once "services/insert_or_update_users.php";
use PHPUnit\Framework\TestCase;

class InputOrUpdateUsersTest extends TestCase
{
    private $all_valid_file_path = "tests/all_valid.csv";
    private $invalid_email_file_path = "tests/invalid_email.csv";
    private $invalid_file_path = "tests/users.csv";
    private $invalid_csv_format_path = "tests/invalid_csv_format.csv";

    /**
     * Test All valid user data
     * @test
     */
    public function test_argument_value_file() {
        $this->assertEquals(
            "Processed 2 entries. 0 user(s) not processed due to invalid email address.",
            insert_or_update_users($this->all_valid_file_path, false)
        );
    }

    /**
     * Test Invalid user data
     * @test
     */
    public function test_invalid_user_data() {
        $this->assertEquals(
            "User Edward Jikes was not inserted because invalid email address: edward@jikes@com.au\nProcessed 1 entries. 1 user(s) not processed due to invalid email address.",
            insert_or_update_users($this->invalid_email_file_path, false)
        );
    }

    /**
     * Test Invalid File Path
     * @test
     */
    public function test_invalid_file_path() {
        $this->assertEquals(
            "Import CSV IOException triggered: Could not open tests/users.csv for reading! File does not exist.",
            insert_or_update_users($this->invalid_file_path, false)
        );
    }

    /**
     * Test Invalid CSV Format
     * @test
     */
    public function test_invalid_csv_format() {
        $this->assertEquals(
            "Invalid CSV format. Please provide a valid CSV format with headers: name, surname, email.",
            insert_or_update_users($this->invalid_csv_format_path, false)
        );
    }
}