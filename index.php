<?php
$currentCategory = "toys";

$products = [
    ["Dog Kibble", 250, 18],
    ["Cat Wet Food Pack", 120, 25],
    ["Dog Biscuits", 75, 18],
    ["Cat Salmon Bites", 60, 12],
    ["Rubber Ball", 50, 40],
    ["Rope Tug Toy", 80, 22],
    ["Plush Duck Toy", 95, 15]
];

$categoryDescriptions = [
    "food" => "Check out our selection of dog and cat food",
    "treats" => "Treats and snacks for your furry friends",
    "toys" => "Fun toys to keep your pets entertained"
];

$categoryNotes = [
    "food" => "All our food meets basic nutrition standards",
    "treats" => "Remember: treats should be given in moderation",
    "toys" => "Safety tip: regularly check toys for wear and tear"
];

$welcomeMessage = $categoryDescriptions[$currentCategory] ?? "Browse our pet products";
$safetyNote = $categoryNotes[$currentCategory] ?? "Thanks for shopping with us!";

$displayTitle = match($currentCategory) {
    "food" => "Food Products",
    "treats" => "Treats & Snacks", 
    "toys" => "Pet Toys",
    default => "All Products"
};

$regularPrice = 50;
$discountAmount = 10;
$salePrice = $regularPrice - $discountAmount;
$finalPrice = $salePrice * 1.12;

$totalInventory = 0;
$productNames = [];

foreach ($products as $item) {
    $totalInventory += $item[2];
    $productNames[] = $item[0];
}

$productNamesString = implode(", ", $productNames);

include 'header.php';
?>

<div class="category-info">
    <p class="note"><?= $safetyNote ?></p>
    <h1><?= $welcomeMessage ?></h1>
    <h2><?= $displayTitle ?></h2>
</div>

<div class="products">
    <h2>Available Products</h2>
    <table class="inventory-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price (₱)</th>
                <th>In Stock</th>
                <th>Stock Level</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): 
                $name = $product[0];
                $price = $product[1];
                $stock = $product[2];

                if ($stock > 30) {
                    $stockStatus = "High";
                } elseif ($stock > 15) {
                    $stockStatus = "Good";
                } else {
                    $stockStatus = "Low";
                }
            ?>
            <tr>
                <td><?= $name ?></td>
                <td>₱<?= number_format($price, 2) ?></td>
                <td><?= $stock ?></td>
                <td class="stock-<?= strtolower($stockStatus) ?>"><?= $stockStatus ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="store-info">
    <h3>Store Summary</h3>
    <p><strong>Total items in stock:</strong> <?= $totalInventory ?></p>
    <p><strong>All products:</strong> <?= $productNamesString ?></p>
</div>

<div class="promo-section">
    <h3>Special Offer</h3>
    <p>Regular price: ₱<?= number_format($regularPrice, 2) ?></p>
    <p>Sale price: ₱<?= number_format($salePrice, 2) ?></p>
    <p class="final-price">Total with tax: ₱<?= number_format($finalPrice, 2) ?></p>
</div>

<?php include 'footer.php'; ?>
