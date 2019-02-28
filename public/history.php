<?php

    // configuration
    require("../includes/config.php");

    $csv = @fopen("logs/log_{$_SESSION["id"]}.csv", "r");
    if ($csv === false)
    {
        // trigger (big, orange) error
        trigger_error("Could not open!", E_USER_ERROR);
        exit;
    }
    //$data = fgetcsv($csv);
    //$data = [];

    while (($row = fgetcsv($csv)) !== FALSE) {
        $data[] = $row;
    }

    fclose($csv);

    render("history_form.php", ["data" => $data, "title" => "History"]);

?>