<?php
require_once "models/User.php";
require_once "remove_whitespace_characters.php";
require_once "handle_sanitise_name.php";
require_once "sanitise_array_keys.php";
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Reader\Exception\ReaderNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;

/**
 * Function that handles insertion / updating of users in the database. If an email address already exists, the name
 * and surname of the user will be updated
 * @param string $csv_file file path to CSV file
 * @param bool $insert_to_db flag whether to insert / update users in the database
 * @return string
 */
function insert_or_update_users($csv_file, $insert_to_db) {
    $output = "";
    $insert_count = 0;
    $not_insert_count = 0;
    try {
        $users = sanitise_array_keys((new FastExcel())->import($csv_file)->toArray());
    } catch (IOException $e) {
        return "Import CSV IOException triggered: " . $e->getMessage() . "\n";
    } catch (UnsupportedTypeException $e) {
        return "Import CSV UnsupportedTypeException triggered: " . $e->getMessage() . "\n";
    } catch (ReaderNotOpenedException $e) {
        return "Import CSV ReaderNotOpenedException triggered: " . $e->getMessage() . "\n";
    }
    foreach ($users as $user) {
        //Formatting user data
        $keys = array_keys($user);
        if (count($keys) < 3) {
            return "Invalid CSV format. Please provide a valid CSV format with headers: name, surname, email.\n";
        }
        $name = handle_sanitise_name($user[$keys[0]], false);
        $surname = handle_sanitise_name($user[$keys[1]], true);
        $email = remove_whitespace_characters(strtolower($user[$keys[2]]));

        //Validating user email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Invalid email address, so we cannot enter user here!
            $output .= "User $name $surname was not inserted because invalid email address: $email\n";
            $not_insert_count++;
            continue;
        }

        if ($insert_to_db) {
            try {
                User::updateOrCreate(
                    ['email' => strtolower($user['email'])],
                    ['name' => $name, 'surname' => $surname]
                );
            } catch (PDOException $exception) {
                return "Fail to insert / update user " . $exception->getMessage() . "\n";
            }
        }
        $insert_count++;
    }
    $output .= "Processed $insert_count entries. $not_insert_count user(s) not processed due to invalid email address.\n";
    return $output;
}