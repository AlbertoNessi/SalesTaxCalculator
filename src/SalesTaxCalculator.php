<?php

define("BASIC_SALES_TAX", 10);
// all imported products, no exemptions
define("IMPORT_DUTY", 5);

// those are the product types that are exempt from the basicSalesTax
$exceptTypes = [
    'books',
    'food',
    'medical'
];

// inputs
$baskets = [
    "basket1" => [
        [
            'product_name' => "book",
            'qty' => 2,
            'type' => "books",
            'imported' => false,
            'price' => 12.49,
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
    ],
    "basket2" => [
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
    ],
    "basket3" => [
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
    ]
];

foreach ($baskets as &$basket) {
    $taxes = 0;
    $tot_cost = 0;

    foreach ($basket as $kBasket => $vBasket) {
        foreach ($vBasket as $key => $value) {

            if ($key == "type" && in_array($value, $exceptTypes)) {
                $except = true;
            } else {
                $except = false;
            }
            
            if ($key == "price"){
                if(!$except) {
                    $taxes += $value * BASIC_SALES_TAX / 100;
                }
                $tot_cost += $value;
            }

            if ($key == "imported") {
                if ($value) {
                    $taxes += $value * IMPORT_DUTY / 100;;
                }
            }

            if ($key == "qty") {
                $taxes *= $value;
                $tot_cost *= $value;
            }
        }
    }
    $basket['sales_taxes'] = $taxes;
    $basket['total'] = $tot_cost;
}

$return = [
    "baskets" => $baskets,
    'exceptTypes' => $exceptTypes
];

echo json_encode($return);
