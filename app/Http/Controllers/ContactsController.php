<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    //
    public function store(Request $request)
    {
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'company' => $request->company,
        ]);
    }
}
