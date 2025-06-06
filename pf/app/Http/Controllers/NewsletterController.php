<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscribed;
use Illuminate\Support\Facades\Log;
use Exception;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|email',
            ]);
            
            Mail::to($data['email'])->send(new NewsletterSubscribed());
            Log::info('Correo de confirmación enviado a: ' . $data['email']);
            return back()->with('success', '¡Correo de confirmación enviado!');
        } catch (Exception $e) {
            Log::error('Error al enviar correo a: ' . $data['email'] . '. Error: ' . $e->getMessage());
            return back()->with('error', '¡Error al enviar el correo de confirmación!');
        }
    }
}