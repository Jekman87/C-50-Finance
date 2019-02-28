<?php
    // configuration
    require("../includes/config.php");

    if ($_POST)
    {
        // validate submission
        if (empty($_POST["curPassword"]) || empty($_POST["newPassword"]) || empty($_POST["confirmation"]))
        {
            apologize("Fill in all the fields.");
        }
        else if ($_POST["newPassword"] != $_POST["confirmation"])
        {
            apologize("Passwords must match.");
        }

        $hash = CS50::query("SELECT hash FROM users WHERE id = ?", $_SESSION["id"]);

        if (password_verify($_POST["curPassword"], $hash[0]["hash"]))
        {
            CS50::query("UPDATE users SET hash = ? WHERE id = ?", password_hash($_POST["newPassword"], PASSWORD_DEFAULT), $_SESSION["id"]);
        }
        else
        {
            apologize("Current password is incorrect.");
        }

        redirect("/");
    }

    render("change_pass_form.php", ["title" => "Change password"]);

?>
