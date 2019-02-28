<table class="table table-striped">
    <thead>
        <tr>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($positions as $position): ?>

            <tr>
                <td><?= $position["symbol"] ?></td>
                <td><?= $position["shares"] ?></td>
                <td>$<?= number_format($position["price"], 4, '.', ',') ?></td>
                <td>$<?= number_format($position["total"], 2, '.', ',') ?></td>
            </tr>

        <?php endforeach; ?>

        <tr>
            <td colspan="3">CASH</td>
            <td>$<?= htmlspecialchars(number_format($cash, 2, '.', ',')) ?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td><b>$<?= htmlspecialchars(number_format($totalAll, 2, '.', ',')) ?></b></td>
        </tr>
    </tfoot>
</table>
