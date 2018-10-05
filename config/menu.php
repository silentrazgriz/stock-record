<?php

return [
    'guest' => [
        [
            'type' => 'title',
            'text' => 'Main Menu'
        ],
        [
            'type' => 'link',
            'text' => 'Login',
            'icon' => 'fas fa-sign-in-alt',
            'route' => 'login'
        ],
        [
            'type' => 'link',
            'text' => 'Register',
            'icon' => 'fas fa-address-book',
            'route' => 'register'
        ],
    ],
    'authenticated' => [
        [
            'type' => 'title',
            'text' => 'Main Menu'
        ],
        [
            'type' => 'link',
            'text' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'route' => 'root'
        ],
        [
            'type' => 'link',
            'text' => 'Your Accounts',
            'icon' => 'fas fa-users',
            'route' => 'user-accounts.index'
        ],
        [
            'type' => 'link',
            'text' => 'Transaction',
            'icon' => 'fas fa-exchange-alt',
            'route' => 'records.index'
        ],
        [
            'type' => 'link',
            'text' => 'Deposit',
            'icon' => 'fas fa-credit-card',
            'route' => 'deposits.index'
        ],
        [
            'type' => 'link',
            'text' => 'Quote',
            'icon' => 'fas fa-file-alt',
            'route' => 'quotes.index'
        ],
        [
            'type' => 'link',
            'text' => 'Broker Account',
            'icon' => 'fas fa-cube',
            'route' => 'broker-accounts.index'
        ],
        [
            'type' => 'link',
            'text' => 'Holiday',
            'icon' => 'fas fa-calendar-alt',
            'route' => 'off-days.index'
        ],
        [
            'type' => 'logout',
            'text' => 'Logout',
            'icon' => 'fas fa-sign-out-alt',
            'route' => 'logout'
        ]
    ]
];