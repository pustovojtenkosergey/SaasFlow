<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{


    public function getRandomContact()
    {
        return Contact::inRandomOrder()->first();
    }
}
