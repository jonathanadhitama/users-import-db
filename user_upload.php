<?php
require_once "./services/validate_and_execute_command.php";

$stdout = validate_and_execute($argv);
echo $stdout;