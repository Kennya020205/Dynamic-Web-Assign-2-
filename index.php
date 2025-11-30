<?php
// Pet store product display
$current_category = "toys";

// Our product inventory
$products = [
    ["Dog Kibble", 18, 30],
    ["Cat Wet Food Pack", 10, 25],
    ["Dog Biscuits", 6, 18],
    ["Cat Salmon Bites", 5, 12],
    ["Rubber Ball", 5, 40],
    ["Rope Tug Toy", 7, 22],
    ["Plush Duck Toy", 9, 15]
];

// Category descriptions
$category_descriptions = [
    "food" => "Check out our selection of dog and cat food",
    "treats" => "Treats and snacks for your furry friends",
    "toys" => "Fun toys to keep your pets entertained"
];

// Important notes for each category
$category_notes = [
    "food" => "All our food meets basic nutrition standards",
    "treats" => "Remember: treats should be given in moderation",
    "toys" => "Safety tip: regularly check toys for wear and tear"
];

// Get the right message for our current category
$welcome_message = $category_descriptions[$current_category] ?? "Browse our pet products";
$safety_note = $category_notes[$current_category] ?? "Thanks for shopping with us!";

// Figure out what we're showing
$display_title = match($current_category) {
    "food" => "Food Products",
    "treats" => "Treats & Snacks", 
    "toys" => "Pet Toys",
    default => "All Products"
};

// Promo box calculations
$regular_price = 50;
$discount_amount = 10;
$sale_price = $regular_price - $discount_amount;
$final_price = $sale_price * 1.12; // Adding tax

// Quick type conversion example
$string_number = "30";
$actual_number = 20;
$combined_total = $string_number + $actual_number;

// Stock calculations
$total_inventory = 0;
foreach ($products as $item) {
    $total_inventory += $item[2];
}

// Get all product names for display
$all_products_list = [];
foreach ($products as $item) {
    $all_products_list[] = $item[0];
}
$product_names_string = implode(", ", $all_products_list);

include 'header.php';
?>

<div class="category-info">
    <p class="note"><?= $safety_note ?></p>
    <h1><?= $welcome_message ?></h1>
    <h2><?= $display_title ?></h2>
</div>

<div class="products">
    <h2>Available Products</h2>
    <table class="inventory-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>In Stock</th>
                <th>Stock Level</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <?php 
                    $product_name = $product[0];
                    $product_price = $product[1];
                    $product_stock = $product[2];
                    
                    // Determine stock status
                    if ($product_stock > 30) {
                        $stock_status = "High";
                    } elseif ($product_stock > 15) {
                        $stock_status = "Good"; 
                    } else {
                        $stock_status = "Low";
                    }
                ?>
                <tr>
                    <td><?= $product_name ?></td>
                    <td>$<?= $product_price ?></td>
                    <td><?= $product_stock ?></td>
                    <td class="stock-<?= strtolower($stock_status) ?>"><?= $stock_status ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="store-info">
    <h3>Store Summary</h3>
    <p><strong>Total items in stock:</strong> <?= $total_inventory ?></p>
    <p><strong>All products:</strong> <?= $product_names_string ?></p>
</div>

<div class="promo-section">
    <h3>Special Offer</h3>
    <p>Regular price: $<?= $regular_price ?></p>
    <p>Sale price: $<?= $sale_price ?></p>
    <p class="final-price">Total with tax: $<?= number_format($final_price, 2) ?></p>
</div>

<?php include 'footer.php'; ?>