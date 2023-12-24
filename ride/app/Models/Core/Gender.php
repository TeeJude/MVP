<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function createGender()
    {
        $genders = [
            'male', 'female', 'others'
        ];

        foreach ($genders as $gender) {

            $existignGender = Gender::where(['gender' => $gender])->first();
            if (!$existignGender) {
                $g = new Gender();
                $g->gender = $gender;
                $g->save();
            }
        }
    }
}