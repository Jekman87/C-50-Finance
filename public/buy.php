<?php
    // configuration
    require("../includes/config.php");


    if (!$_POST)
    {
        render("buy_form.php", ["title" => "Buy"]);
    }

    if ($_POST)
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("Missing symbol.");
        }
        else if (empty($_POST["shares"]))
        {
            apologize("Missing shares.");
        }
        else if (!preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("Enter a non-negative integer.");
        }

        $_POST["symbol"] = strtoupper($_POST["symbol"]);

        $symbol = lookup($_POST["symbol"]);

        $cost = $symbol["price"] * $_POST["shares"];

        $row = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);

        if ($cost > $row["0"]["cash"])
        {
            apologize("Can't afford.");
        }

        CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]);

        CS50::query("INSERT INTO portfolios (user_id, symbol, shares) VALUES( ?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"]);

        $csv = @fopen("logs/log_{$_SESSION["id"]}.csv", "a");
        if ($csv === false)
        {
            // trigger (big, orange) error
            trigger_error("Could not open!", E_USER_ERROR);
            exit;
        }

        $field = [$_POST["symbol"], $_POST["shares"], $symbol["price"], date("Y-m-d H:i:s")];

        fputcsv($csv, $field);
        fclose($csv);

        redirect("/");
    }

?>