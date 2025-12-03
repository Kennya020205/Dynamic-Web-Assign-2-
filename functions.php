<?php
declare(strict_types=1);

$products = [
    "Dog Kibble" => [250, 18],
    "Cat Wet Food Pack" => [120, 25],
    "Dog Biscuits" => [75, 18],
    "Cat Salmon Bites" => [60, 12],
    "Rubber Ball" => [50, 40],
    "Rope Tug Toy" => [80, 22],
    "Plush Duck Toy" => [95, 15],
    "Catnip Mouse Toy" => [45, 30],
    "Dog Chew Bone" => [110, 14],
    "Fish Food Flakes" => [90, 28],
    "Bird Seed Mix" => [130, 16],
    "Hamster Wheel" => [350, 9]
];

$taxRate = 12;

function get_reorder_message(int $stock): string {
    return $stock < 10 ? "Yes" : "No";
}

function get_total_value(float $price, int $quantity): float {
    return $price * $quantity;
}

function get_tax_due(float $price, int $quantity, int $taxRate = 0): float {
    return ($price * $quantity) * ($taxRate / 100);
}

include 'header.php';
?>

<div class="products">
    <h2>Stock Monitoring</h2>
    <table class="inventory-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price (PHP)</th>
                <th>Stock</th>
                <th>Reorder?</th>
                <th>Total Value (PHP)</th>
                <th>Tax Due (PHP)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product_name => $data): ?>
                <?php 
                    $price = $data[0];
                    $stock = $data[1];
                ?>
                <tr>
                    <td><?= $product_name ?></td>
                    <td>₱<?= number_format($price, 2) ?></td>
                    <td><?= $stock ?></td>
                    <td><?= get_reorder_message($stock) ?></td>
                    <td>₱<?= number_format(get_total_value($price, $stock), 2) ?></td>
                    <td>₱<?= number_format(get_tax_due($price, $stock, $taxRate), 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
