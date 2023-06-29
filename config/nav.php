<?php
return [
    [
      'icon'=>'nav-icon fas fa-tachometer-alt',
      'route'=>'dashboard',
        'title'=>'Dashboard',
        'active' => 'dashboard',
    ],
    [
        'icon'=>'far fa-circle nav-icon',
        'route'=>'categories.index',
        'title'=>'Categories',
        'active' => 'categories.*',
        'ability' => 'category.view',
    ],
    [
        'icon' => 'fas fa-box nav-icon',
        'route' => 'products.index',
        'title' => 'Products',
        'active' => 'products.*',
        'ability' => 'product.view',
    ],
    [
        'icon' => 'fas fa-receipt nav-icon',
        'route' => 'orders.index',
        'title' => 'Orders',
        'active' => 'orders.*',
        'ability' => 'order.view',
    ],
    [
        'icon' => 'fas fa-users nav-icon',
        'route' => 'users.index',
        'title' => 'Users',
        'active' => 'users.*',
        'ability' => 'user.view',
    ],
    [
        'icon' => 'fas fa-users nav-icon',
        'route' => 'admins.index',
        'title' => 'Admins',
        'active' => 'admins.*',
        'ability' => 'admin.view',
    ],
    [
        'icon' => 'fas fa-shield nav-icon',
        'route' => 'roles.index',
        'title' => 'Roles',
        'active' => 'roles.*',
        'ability' => 'role.view',
    ],
];
