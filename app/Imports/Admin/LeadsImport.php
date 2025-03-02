<?php

namespace App\Imports\Admin;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {   
        $nameParts = explode(' ', trim($row['name']), 2);
        $firstname = $nameParts[0];
        $lastname = $nameParts[1] ?? '';
        
        return new Lead([
            'firstname'  => $firstname,
            'lastname'  => $lastname,
            'email' => $row['email'],
            'phone' => $row['phone'],
            'password' => Hash::make('password'),
            'state' => $row['state'],
            'city'  => $row['city'],
        ]);
    }
}
