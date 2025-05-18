<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterSubscribed;
use Illuminate\Support\Facades\Log; // Importa la clase Log
use Exception; // Importa la clase Exception

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        try {
            Mail::to($data['email'])->send(new NewsletterSubscribed());

            // Si llegamos aquí, asumimos que el envío fue exitoso (Laravel no lanza excepción por fallos SMTP)
            // Es mejor registrar esto y manejarlo con colas para mayor seguridad
            Log::info('Correo de confirmación enviado a: ' . $data['email']);

            return back()->with('success', '¡Correo de confirmación enviado!');

        } catch (Exception $e) {
            Log::error('Error al enviar correo a: ' . $data['email'] . '. Error: ' . $e->getMessage());
            return back()->with('error', '¡Error al enviar el correo de confirmación!');
        }
    }
}