<?php
    // configuration
    require("../includes/config.php");


    if (!$_POST)
    {
        $rows = CS50::query("SELECT symbol FROM portfolios WHERE user_id = ?", $_SESSION["id"]);

        render("sell_form.php", ["rows" => $rows, "title" => "Sell"]);
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

        $row = CS50::query("SELECT shares FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);

        if ($row["0"]["shares"] < $_POST["shares"])
        {
            apologize("You cannot sell more shares than you have.");
        }
        else if ($row["0"]["shares"] == $_POST["shares"])
        {
            CS50::query("DELETE FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        }
        else
        {
            CS50::query("UPDATE portfolios SET shares = shares - ? WHERE user_id = ? AND symbol = ?", $_POST["shares"], $_SESSION["id"], $_POST["symbol"]);
        }

        $symbol = lookup($_POST["symbol"]);

        $sellCash = $_POST["shares"] * $symbol["price"];

        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $sellCash, $_SESSION["id"]);

        $csv = @fopen("logs/log_{$_SESSION["id"]}.csv", "a");
        if ($csv === false)
        {
            // trigger (big, orange) error
            trigger_error("Could not open!", E_USER_ERROR);
            exit;
        }

        $field = [$_POST["symbol"], -$_POST["shares"], $symbol["price"], date("Y-m-d H:i:s")];

        fputcsv($csv, $field);
        fclose($csv);

        redirect("/");
    }

?>