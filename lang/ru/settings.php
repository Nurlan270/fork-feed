<?php

return [
    'title'        => 'Настройки',
    'save_changes' => 'Сохранить',

    'profile_images' => [
        'title'  => 'Изображения профиля',
        'banner' => [
            'label'             => 'Баннер',
            'alt'               => 'Текущий баннер',
            'upload_text'       => 'Загрузить новый баннер',
            'file_requirements' => 'JPG, JPEG или PNG. Максимальный размер 5МБ',
        ],
        'avatar' => [
            'label'             => 'Аватар',
            'alt'               => 'Текущий аватар',
            'update_text'       => 'Обновить аватар',
            'file_requirements' => 'JPG, JPEG или PNG. Максимальный размер 5МБ',
        ],
    ],

    'profile_information' => [
        'title'    => 'Информация профиля',
        'name'     => [
            'label' => 'Отображаемое имя',
        ],
        'username' => [
            'label' => 'Имя пользователя',
        ],
    ],

    'security' => [
        'title'            => 'Безопасность',
        'current_password' => [
            'label'       => 'Текущий пароль',
            'placeholder' => 'Введите текущий пароль',
        ],
        'new_password'     => [
            'label'       => 'Новый пароль',
            'placeholder' => 'Введите новый пароль',
        ],
        'confirm_password' => [
            'label'       => 'Подтвердите пароль',
            'placeholder' => 'Подтвердите новый пароль',
        ],
    ],

    'preferences' => [
        'title'    => 'Настройки',
        'language' => [
            'title'       => 'Язык',
            'description' => 'Выберите предпочитаемый язык',
        ],
    ],
];
