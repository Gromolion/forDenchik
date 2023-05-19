<?php

namespace App\Controllers;

class ProfileController {

    public function index($id): array
    {
        return [
            'id' => $id,
            'name' => 'Tony',
            'gender' => 'male',
        ];
    }

}