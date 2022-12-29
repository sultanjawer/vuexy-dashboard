<?php


return [
    "create-sale" => [
        #Form One
        'offer_code' => "",
        'neighborhood_name' => "",
        'land_number' => "",
        'space' => "",
        'price' => "",
        'vat' => "",
        'saee_type' => "",
        'saee_prc' => "",
        'saee_price' => "",
        'total_price' => "",
        'paid_amount' => "",

        #Recieved Offer
        'offer' => "",
        'order' => "",
        'offer_id' => "",

        'customer_seller' => "",
        'customer_buyer' => "",

        'cash' => '',
        'check' => 'option2',
        'bank' => '',

        'customers' => [],
        'customers_ids' => "",

        // Buyer Customer
        'customer_buyer_id' => "",
        'customer_buyer_name' => "",
        'customer_buyer_phone' => "",
        'customer_buyer_email' => "",
        'customer_buyer_id_number' => "",
        'customer_buyer_nationality' => "",
        'customer_buyer_city_name' => "",
        'customer_buyer_employee_type' => "",
        'customer_buyer_support_eskan' => "",
        'customer_buyer_public' => '',
        'customer_buyer_private' => '',
        'customer_buyer_yes' => '',
        'customer_buyer_no' => '',

        #Form Three
        'customer_buyer_building_number' => "",
        'customer_buyer_street_name' => "",
        'customer_buyer_neighborhood' => "",
        'customer_buyer_zip_code' => "",
        'customer_buyer_addtional_number' => "",
        'customer_buyer_unit_number' => "",

        // Seller Customer
        'customer_seller_id' => "",
        'customer_seller_name' => "",
        'customer_seller_phone' => "",
        'customer_seller_email' => "",
        'customer_seller_id_number' => "",
        'customer_seller_nationality' => "",
        'customer_seller_city_name' => "",
        'customer_seller_employee_type' => "",
        'customer_seller_support_eskan' => "",
        'customer_seller_public' => '',
        'customer_seller_private' => '',
        'customer_seller_yes' => '',
        'customer_seller_no' => '',

        #Form Three
        'customer_seller_building_number' => "",
        'customer_seller_street_name' => "",
        'customer_seller_neighborhood' => "",
        'customer_seller_zip_code' => "",
        'customer_seller_addtional_number' => "",
        'customer_seller_unit_number' => "",

        "fields" => [
            #Offer
            'offer_code',
            'neighborhood_name',
            'land_number',
            'space',
            'price',
            'vat',
            'saee_prc',
            'saee_price',
            'total_price',
            'paid_amount',

            // 'cash',
            // 'check',
            // 'bank',

            #Customer
            'customer_name',
            'customer_phone',
            'customer_email',
            'customer_id_number',
            'customer_nationality',
            'customer_city_name',
            // 'employee_type',
            // 'public',
            // 'private',

            'building_number',
            'street_name',
            'neighborhood',
            'zip_code',
            'addtional_number',
            'unit_number',
        ]

    ],
    "update-sale" => [],
];
