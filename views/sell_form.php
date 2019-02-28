<form action="sell.php" method="post">
    <div class="form-group">
        <select class="form-control" name="symbol">
            <option disabled selected value="">Symbol</option>

                <?php foreach ($rows as $row): ?>

                    <option value="<?= $row["symbol"] ?>"><?= $row["symbol"] ?></option>

                <?php endforeach; ?>

        </select>
    </div>
    <div class="form-group">
        <input autocomplete="off" class="form-control" min="0" name="shares" placeholder="Shares" type="number">
    </div>
    <button class="btn btn-primary" type="submit">Sell</button>
</form>