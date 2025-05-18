<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscribed;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        // Envía el correo
        Mail::to($data['email'])->send(new NewsletterSubscribed());

        return back()->with('success', '¡Correo de confirmación enviado!');
    }
}

