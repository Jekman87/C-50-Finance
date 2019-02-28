<?php
    // configuration
    require("../includes/config.php");

    if (empty($_POST["symbol"]))
    {
        render("quote_form.php", ["title" => "Quote"]);
    }

    $stock = lookup($_POST["symbol"]);

    if ($stock === false)
    {
        apologize("Invalid sumbol.");
    }

    render("quote_answer.php", ["title" => "Quoted", "symbol" => $stock['symbol'], "price" => $stock['price']]);

?>