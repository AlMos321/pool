<?php
return [
    'title' => 'Пользователи',
    'single' => 'пользователя',
    'model' => 'App\User',
    /**
     * The display columns
     */
    'columns' => [
        'id' => [
            'title' => '#'
        ],
        'name' => [
            'title' => 'Имя'
        ],
        'surname' => [
            'title' => 'Фамилия'
        ],
        'email' => [
            'title' => 'Email'
        ],
        'is_admin' => [
            'title' => 'Администратор'
        ],
        'phone' => [
            'title' => 'Телефон',
        ],
    ],
    /**
     * The editable fields
     */
    'edit_fields' => [
        'name' => [
            'type' => 'text',
            'title' => 'Имя'
        ],
        'surname' => [
            'type' => 'text',
            'title' => 'Фамилия'
        ],
        'email' => [
            'type' => 'text',
            'title' => 'Email'
        ],
        'password' => [
            'type' => 'password',
            'title' => 'Пароль',
        ],
        'phone' => [
            'type' => 'text',
            'title' => 'Телефон',
        ],
        'is_admin' => [
            'type' => 'bool',
            'title' => 'Администратор'
        ],
    ],
    /**
     * The filter fields
     *
     * @type array
     */
    'filters' => [
        'id',
        'name' => [
            'title' => 'Имя',
        ],
        'email' => [
            'title' => 'Email',
        ],
    ],
];