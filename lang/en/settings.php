<?php

return [
    'title'        => 'Settings',
    'save_changes' => 'Save Changes',

    'profile_images' => [
        'title'  => 'Profile Images',
        'banner' => [
            'label'             => 'Banner Image',
            'alt'               => 'Current banner',
            'upload_text'       => 'Upload new banner',
            'file_requirements' => 'JPG, JPEG or PNG. Max size 5MB',
        ],
        'avatar' => [
            'label'             => 'Profile Picture',
            'alt'               => 'Current avatar',
            'update_text'       => 'Update your avatar',
            'file_requirements' => 'JPG, JPEG or PNG. Max size 5MB',
        ],
    ],

    'profile_information' => [
        'title'    => 'Profile Information',
        'name'     => [
            'label' => 'Display Name',
        ],
        'username' => [
            'label' => 'Username',
        ],
    ],

    'security' => [
        'title'            => 'Security',
        'current_password' => [
            'label'       => 'Current Password',
            'placeholder' => 'Enter current password',
        ],
        'new_password'     => [
            'label'       => 'New Password',
            'placeholder' => 'Enter new password',
        ],
        'confirm_password' => [
            'label'       => 'Confirm Password',
            'placeholder' => 'Confirm new password',
        ],
    ],

    'preferences' => [
        'title'    => 'Preferences',
        'language' => [
            'title'       => 'Language',
            'description' => 'Select your preferred language',
        ],
    ],
];
