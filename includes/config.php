<?php
declare(strict_types=1);

// Basic config + demo data (no database).
// Backend integration point: replace these arrays with DB queries / API calls.

const SITE_NAME = 'LeafMart';
const SITE_TAGLINE = 'Fresh & Organic Groceries';
const SHOP_CURRENCY_SYMBOL = '৳';

/**
 * @return array<int, array<string, mixed>>
 */
function demo_products(): array {
    return [
        [
            'id' => 'apple-500g',
            'name' => 'Fresh Organic Apples',
            'category' => 'Fruits',
            'tags' => ['Organic', 'Seasonal'],
            'unit' => '500g',
            'price' => 180,
            'stock' => 32,
            'on_sale' => true,
            'rating' => 4.6,
            'image' => 'assets/images/products/apples.png',
            'description' => 'Crisp, farm-fresh apples picked at peak sweetness.',
        ],
        [
            'id' => 'banana-dozen',
            'name' => 'Ripe Bananas',
            'category' => 'Fruits',
            'tags' => ['Seasonal'],
            'unit' => '1 dozen',
            'price' => 60,
            'stock' => 85,
            'on_sale' => false,
            'rating' => 4.4,
            'image' => 'assets/images/products/bananas.png',
            'description' => 'Naturally sweet bananas—perfect for snacks and smoothies.',
        ],
        [
            'id' => 'strawberry-250g',
            'name' => 'Organic Strawberries',
            'category' => 'Fruits',
            'tags' => ['Organic', 'Seasonal'],
            'unit' => '250g',
            'price' => 250,
            'stock' => 18,
            'on_sale' => true,
            'rating' => 4.8,
            'image' => 'assets/images/products/strawberries.png',
            'description' => 'Juicy berries with bright flavor and aroma.',
        ],
        [
            'id' => 'mango-1kg',
            'name' => 'Sweet Mangoes',
            'category' => 'Fruits',
            'tags' => ['Seasonal'],
            'unit' => '1kg',
            'price' => 200,
            'stock' => 26,
            'on_sale' => false,
            'rating' => 4.7,
            'image' => 'assets/images/products/mangoes.png',
            'description' => 'Golden mangoes—silky, sweet, and sun-ripened.',
        ],
        [
            'id' => 'orange-1kg',
            'name' => 'Fresh Oranges',
            'category' => 'Fruits',
            'tags' => [],
            'unit' => '1kg',
            'price' => 150,
            'stock' => 41,
            'on_sale' => false,
            'rating' => 4.5,
            'image' => 'assets/images/products/oranges.png',
            'description' => 'Vitamin-rich oranges with a zesty kick.',
        ],
        [
            'id' => 'grapes-500g',
            'name' => 'Green Grapes',
            'category' => 'Fruits',
            'tags' => [],
            'unit' => '500g',
            'price' => 220,
            'stock' => 20,
            'on_sale' => false,
            'rating' => 4.3,
            'image' => 'assets/images/products/grapes.jpg',
            'description' => 'Crunchy grapes—clean, crisp sweetness.',
        ],
        [
            'id' => 'watermelon-whole',
            'name' => 'Watermelon',
            'category' => 'Fruits',
            'tags' => ['Seasonal'],
            'unit' => 'whole',
            'price' => 120,
            'stock' => 12,
            'on_sale' => true,
            'rating' => 4.2,
            'image' => 'assets/images/products/watermelon.jpg',
            'description' => 'Hydrating, refreshing—perfect for warm days.',
        ],
        [
            'id' => 'papaya-1kg',
            'name' => 'Papaya',
            'category' => 'Fruits',
            'tags' => [],
            'unit' => '1kg',
            'price' => 80,
            'stock' => 29,
            'on_sale' => false,
            'rating' => 4.1,
            'image' => 'assets/images/products/papaya.jpg',
            'description' => 'Soft, mellow sweetness with a tropical aroma.',
        ],
        [
            'id' => 'tomato-1kg',
            'name' => 'Fresh Tomatoes',
            'category' => 'Vegetables',
            'tags' => ['Seasonal'],
            'unit' => '1kg',
            'price' => 60,
            'stock' => 64,
            'on_sale' => false,
            'rating' => 4.4,
            'image' => 'assets/images/products/tomatoes.jpg',
            'description' => 'Plump tomatoes for salads, sauces, and curries.',
        ],
        [
            'id' => 'carrot-500g',
            'name' => 'Organic Carrots',
            'category' => 'Vegetables',
            'tags' => ['Organic'],
            'unit' => '500g',
            'price' => 50,
            'stock' => 55,
            'on_sale' => true,
            'rating' => 4.6,
            'image' => 'assets/images/products/carrots.jpg',
            'description' => 'Sweet, crunchy carrots—great raw or cooked.',
        ],
        [
            'id' => 'cucumber-500g',
            'name' => 'Green Cucumbers',
            'category' => 'Vegetables',
            'tags' => [],
            'unit' => '500g',
            'price' => 40,
            'stock' => 70,
            'on_sale' => false,
            'rating' => 4.2,
            'image' => 'assets/images/products/cucumbers.jpg',
            'description' => 'Cool, crisp cucumbers for salads and raita.',
        ],
        [
            'id' => 'spinach-bunch',
            'name' => 'Fresh Spinach',
            'category' => 'Vegetables',
            'tags' => ['Seasonal'],
            'unit' => 'bunch',
            'price' => 30,
            'stock' => 48,
            'on_sale' => false,
            'rating' => 4.3,
            'image' => 'assets/images/products/spinach.jpg',
            'description' => 'Tender leaves—perfect for stir-fries and soups.',
        ],
        [
            'id' => 'onion-1kg',
            'name' => 'Red Onions',
            'category' => 'Vegetables',
            'tags' => [],
            'unit' => '1kg',
            'price' => 70,
            'stock' => 92,
            'on_sale' => false,
            'rating' => 4.1,
            'image' => 'assets/images/products/onions.jpg',
            'description' => 'Bold flavor—your everyday kitchen essential.',
        ],
        [
            'id' => 'broccoli-500g',
            'name' => 'Organic Broccoli',
            'category' => 'Vegetables',
            'tags' => ['Organic'],
            'unit' => '500g',
            'price' => 150,
            'stock' => 16,
            'on_sale' => true,
            'rating' => 4.5,
            'image' => 'assets/images/products/broccoli.jpg',
            'description' => 'Firm florets—fresh, green, and nutrient-rich.',
        ],
        [
            'id' => 'pepper-500g',
            'name' => 'Bell Peppers',
            'category' => 'Vegetables',
            'tags' => [],
            'unit' => '500g',
            'price' => 120,
            'stock' => 22,
            'on_sale' => false,
            'rating' => 4.2,
            'image' => 'assets/images/products/bell-peppers.jpg',
            'description' => 'Colorful peppers—sweet crunch for any dish.',
        ],
        [
            'id' => 'potato-1kg',
            'name' => 'Fresh Potatoes',
            'category' => 'Vegetables',
            'tags' => [],
            'unit' => '1kg',
            'price' => 45,
            'stock' => 110,
            'on_sale' => false,
            'rating' => 4.0,
            'image' => 'assets/images/products/potatoes.jpg',
            'description' => 'Versatile potatoes—boil, mash, fry, roast.',
        ],
    ];
}

function money(int|float $amount): string {
    return SHOP_CURRENCY_SYMBOL . ' ' . rtrim(rtrim(number_format((float)$amount, 2, '.', ''), '0'), '.');
}

/**
 * @param array<string, mixed> $allowed
 */
function query_string(array $allowed): string {
    $out = [];
    foreach ($allowed as $key => $value) {
        if ($value === null || $value === '' || $value === []) {
            continue;
        }
        $out[$key] = $value;
    }
    return http_build_query($out);
}

function get_qs(string $key, ?string $default = null): ?string {
    $val = $_GET[$key] ?? null;
    if (!is_string($val)) {
        return $default;
    }
    $val = trim($val);
    return $val === '' ? $default : $val;
}

function get_qs_array(string $key): array {
    $val = $_GET[$key] ?? [];
    if (is_string($val)) {
        $val = [$val];
    }
    if (!is_array($val)) {
        return [];
    }
    $out = [];
    foreach ($val as $v) {
        if (is_string($v)) {
            $v = trim($v);
            if ($v !== '') {
                $out[] = $v;
            }
        }
    }
    return array_values(array_unique($out));
}

