<table class="table table-striped">
    <thead>
        <tr>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
            <th>Transacted</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>

            <tr>
                <td><?= $row["0"] ?></td>
                <td><?= $row["1"] ?></td>
                <td>$<?= $row["2"] ?></td>
                <td><?= $row["3"] ?></td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
