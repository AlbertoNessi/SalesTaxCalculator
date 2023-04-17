<?php

$BasicSalesTax = "10";
// all imported products, no exemptions
$ImportDuty = "5";

// those are the product types that are exempt from the BasicSalesTax
$exceptTypes = [
    'books',
    'food',
    'medical'
];

// inputs
$Basket1 = [
    [
        'product_name' => "book",
        'qty' => 2,
        'type' => "books",
        'imported' => false,
        'price' => 12.49
    ],
    [
        'product_name' => "music CD",
        'qty' => 1,
        'type' => "music",
        'imported' => false,
        'price' => 14.99
    ],
    [
        'product_name' => "chocolate bar",
        'qty' => 1,
        'type' => "food",
        'imported' => false,
        'price' => 0.85
    ]
];

$Basket2 = [
    [
        'product_name' => "box of chocolates",
        'qty' => 2,
        'type' => "food",
        'imported' => true,
        'price' => 10.00
    ],
    [
        'product_name' => "bottle of perfume",
        'qty' => 1,
        'type' => "perfume",
        'imported' => true,
        'price' => 47.50
    ]
];

$Basket3 = [
    [
        'product_name' => "bottle of perfume",
        'qty' => 1,
        'type' => "perfume",
        'imported' => true,
        'price' => 27.99
    ],
    [
        'product_name' => "bottle of perfume",
        'qty' => 1,
        'type' => "perfume",
        'imported' => false,
        'price' => 18.99
    ],
    [
        'product_name' => "packet of headache pills",
        'qty' => 1,
        'type' => "medical",
        'imported' => false,
        'price' => 9.75
    ],
    [
        'product_name' => "box of imported chocolates",
        'qty' => 3,
        'type' => "food",
        'imported' => true,
        'price' => 11.25
    ]
];

$return = [
    "basket1" => $Basket1, 
    "basket2" => $Basket2, 
    "basket3" => $Basket3
];

echo json_encode($return);
