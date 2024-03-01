<?php
function loadenv($file) {
    //CHECK THE ENV FILE ACTUALLY EXISTS
    if (!file_exists($file)) {
        throw new RuntimeException('Environment file
        not found: ' . $file);
    }
    //READ THE FILE INTO AN ARRAY
    $lines = file($file, FILE_IGNORE_NEW_LINES |
    FILE_SKIP_EMPTY_LINES);
    #ITERATE THROUGH THE LINES FROM THE ENV FILE
    foreach ($lines as $line) {
        //IGNORE COMMENTS (BEGINNING WITH #)
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        //PUT EACH LINE INTO A NAME/VALUE PAIR

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        //DO SOME CHECKS AND POPULATE THE SERVER AND
        ENV SUPERGLOBALS
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}
//LOAD THE ENVIRONMENT TO MAKE IT READY TO USE
loadEnv(__DIR__ . '/.env');
?>
