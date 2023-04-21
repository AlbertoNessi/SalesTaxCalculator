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
            'price_qty' => 0,
            'taxes' => 0
        ],
        [
            'product_name' => "music CD",
            'qty' => 1,
            'type' => "music",
            'imported' => false,
            'price' => 14.99,
            'price_qty' => 0,
            'taxes' => 0
        ],
        [
            'product_name' => "chocolate bar",
            'qty' => 1,
            'type' => "food",
            'imported' => false,
            'price' => 0.85,
            'price_qty' => 0,
            'taxes' => 0
        ]
    ],
    "basket2" => [
        [
            'product_name' => "box of chocolates",
            'qty' => 2,
            'type' => "food",
            'imported' => true,
            'price' => 10,
            'price_qty' => 0,
            'taxes' => 0
        ],
        [
            'product_name' => "bottle of perfume",
            'qty' => 1,
            'type' => "perfume",
            'imported' => true,
            'price' => 47.50,
            'price_qty' => 0,
            'taxes' => 0
        ]
    ],
    "basket3" => [
        [
            'product_name' => "bottle of perfume",
            'qty' => 1,
            'type' => "perfume",
            'imported' => true,
            'price' => 27.99,
            'price_qty' => 0,
            'taxes' => 0
        ],
        [
            'product_name' => "bottle of perfume",
            'qty' => 1,
            'type' => "perfume",
            'imported' => false,
            'price' => 18.99,
            'price_qty' => 0,
            'taxes' => 0
        ],
        [
            'product_name' => "packet of headache pills",
            'qty' => 1,
            'type' => "medical",
            'imported' => false,
            'price' => 9.75,
            'price_qty' => 0,
            'taxes' => 0
        ],
        [
            'product_name' => "box of imported chocolates",
            'qty' => 3,
            'type' => "food",
            'imported' => true,
            'price' => 11.25,
            'price_qty' => 0,
            'taxes' => 0
        ]
    ]
];

foreach ($baskets as &$basket) {
    $taxes = 0;
    $totCost = 0;

    foreach ($basket as $kBasket => &$vBasket) {
        $except = in_array($vBasket['type'], $exceptTypes);
        $imported = $vBasket['imported'];
        $price = $vBasket['price'];
        $qty = $vBasket['qty'];

        if (!$except) {
            $addBasicSalesTaxValue = $price * BASIC_SALES_TAX / 100;
            // rounding
            $addBasicSalesTaxValue = ceil($addBasicSalesTaxValue * 20) / 20;
            $taxes += $addBasicSalesTaxValue;
        }
        
        if ($imported) {
            $addImportDutyTaxValue = $price * IMPORT_DUTY / 100;
            // rounding
            $addImportDutyTaxValue = ceil($addImportDutyTaxValue * 20) / 20;
            $taxes += $addImportDutyTaxValue;
        }
        
        // totals
        $priceQty = $price * $qty;

        // print_r($price);
        // print_r(" * ");
        // print_r($qty);
        // print_r(" = ");
        // print_r($priceQty);
        
        // print_r(" --NEXT-- ");
        
        $totCost += $priceQty;
        $totCost += $taxes;
        
        // $taxes *= $qty;
        // $totCost *= $qty;

        // product sales tax
        print_r($priceQty);
        print_r("  ");
        
        $vBasket['price_qty'] = $priceQty;
        $vBasket['taxes'] = $taxes;

        $taxes = 0;
        
    }
    // print_r(" ---FINE--- ");

    $basket['sales_taxes'] = $taxes;
    $basket['total'] = $totCost;
}

$return = [
    "baskets" => $baskets,
    'exceptTypes' => $exceptTypes
];

echo json_encode($return);
