<?php

    // configuration
    require("../includes/config.php");

    $rows = CS50::query("SELECT symbol, shares FROM portfolios WHERE user_id = ?", $_SESSION["id"]);

    $positions = [];
    $totalAll = 0;
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "symbol" => $row["symbol"],
                "shares" => $row["shares"],
                "price" => $stock["price"],
                "total" => $row["shares"] * $stock["price"]
            ];
            $totalAll += $row["shares"] * $stock["price"];
        }
    }

    $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    $totalAll += $cash['0']['cash'];

    // render portfolio
    render("portfolio.php", ["positions" => $positions, "cash" => $cash['0']['cash'], "totalAll" => $totalAll, "title" => "Portfolio"]);

?>
