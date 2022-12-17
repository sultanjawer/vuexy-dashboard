<?php

return [

    "fixed" => [
        'sms_page',
        "users_page",
        "can_create_user",
        "can_edit_user",
        "can_show_user",
        "can_change_user_status",
        'cities_page',
        'neighborhoods_page',
        'reservations_page',
        'customers_page',
        'branches_page',
        'orders_page',
        'offers_page',
    ],

    "dynamic" => [

        #Order
        'send_individual_messages',
        'send_collection_messages',
        "can_create_order",
        "can_edit_order",
        "can_show_order",
        "can_change_order_status",
        'mediators_page',

        #Offers
        'can_create_offer',
        'can_edit_offer',
        'can_show_offer',
        'can_change_offer_status',
    ],

    "all" => [
        "users_page",
        "can_create_user",
        "can_edit_user",
        "can_show_user",
        "can_change_user_status",
        'cities_page',
        'neighborhoods_page',
        'reservations_page',
        'customers_page',
        'branches_page',
        'sms_page',
        'send_individual_messages',
        'send_collection_messages',
        'orders_page',
        "can_create_order",
        "can_edit_order",
        "can_show_order",
        "can_change_order_status",
        'mediators_page',

        'offers_page',
        'can_create_offer',
        'can_edit_offer',
        'can_show_offer',
        'can_change_offer_status',
    ]


];
