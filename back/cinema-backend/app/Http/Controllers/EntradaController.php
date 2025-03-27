<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Sessions;
use App\Mail\CorreoEntradas;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
class EntradaController extends Controller
{
    public function index()
    {
        $tickets = Entrada::all();
        return response()->json($tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Obtener el JSON del request
        $data = $request->json()->all();

        // Validar la estructura del JSON
        $validator = Validator::make($data, [
            'session_id' => 'required',
            'cliente' => 'required|array',
            'cliente.email' => 'required',
            'cliente.name' => 'required',
            'cliente.surname' => 'required',
            'cliente.phone_number' => 'required',
            'seats' => 'required|array|min:1|max:10',
            'seats.*' => ['required', 'regex:/^[A-L]-[1-9]|10$/'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Estructura de JSON inválida', 'errors' => $validator->errors()], 400);
        }

        if (!Sessions::where('id_session', $data['session_id'])->exists() ) {
            return response()->json(['message' => 'La sesión no existe'], 404);
        } else {
            $session = Sessions::find($data['session_id']);

            if ($session->day < date("Y-m-d") || $session->day == date("Y-m-d") && $session->hour < date("H:i:s")) {
                return response()->json(['message' => 'La sesión ya ha pasado'], 400);
            }
        }

        // Extraer los datos del cliente y las entradas
        $session_id = $data['session_id'];
        $cliente = $data['cliente'];
        $tickets = $data['seats'];

        $errorCount = 0;
        $seatsInUse = Entrada::where('session_id', $session_id)->pluck('seat')->toArray();

        if (count($seatsInUse) > 0) {
            for ($i = 0; $i < count($tickets); $i++) {
                if (in_array($tickets[$i], $seatsInUse)) {
                    $errorCount++;
                } else if (count(array_unique($tickets)) != count($tickets)) {
                    return response()->json(['message' => 'Los asientos deben ser diferentes'], 400);
                }
            }
        }

        if ($errorCount == 0) {
            // Crear las entradas
            for ($i = 0; $i < count($tickets); $i++) {

                $entrada = new Entrada();

                $entrada->session_id = $session_id;
                $entrada->seat = $tickets[$i];
                $entrada->email = $cliente['email'];
                $entrada->name = $cliente['name'];
                $entrada->surname = $cliente['surname'];
                $entrada->phone_number = $cliente['phone_number'];

                if (str_contains($tickets[$i], 'VIP')) {
                    $entrada->price = $session->priceBase + 2.0;
                } else {
                    $entrada->price = $session->priceBase;
                }

                $entrada->save();

                $session->tickets_sold += 1;
                $session->update();
            }
        }


        if ($errorCount > 0) {
            // Al menos una entrada no pudo ser creada
            return response()->json(['message' => 'Alguna(s) de las entradas no pudo ser creada, por lo cual no se ha hecho la compra', 'errors' => $errorCount], 500);
        } else {
            $data = [
                'session_id' => $session_id,
                'email' => $cliente['email'],
            ];
            $totalPrice = EntradaController::showTotalPurchase($data);
            // Enviar correo
            Mail::to($cliente['email'])->send(new CorreoEntradas($tickets, $cliente, $session_id, $totalPrice));
            // Todas las entradas se crearon correctamente
            return response()->json(['message' => 'Las ' . count($tickets) . ' entradas se crearon correctamente'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showWithIdSession($id)
    {
        if ($id) {
            $session = Sessions::where('id_session', $id)->first();
            if (!$session) {
                return response()->json(['message' => 'La sesión no existe'], 404);
            }
        } else {
            return response()->json(['message' => 'El ID de la sesión es requerido'], 400);
        }

        $tickets = Entrada::where('session_id', $id)->get();

        if ($tickets->isEmpty()) {
            return response()->json(['message' => 'No hay entradas para la sesión con ID ' . $id], 200);
        } else {
            foreach ($tickets as $entrada) {
                $seats[] = $entrada->seat;
            }
            return response()->json($seats);
        }
    }

    /**
     * Validate the email of the user
     */
    public function validateEmail(Request $request) {
        $data = $request->json()->all();
        $validator = Validator::make($data, [
            'session_id' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Estructura de JSON inválida', 'errors' => $validator->errors()], 400);
        }

        $email = $data['email'];
        $session_id = $data['session_id'];
        $tickets = Entrada::where('email', $email)
                        ->where('session_id', $session_id)
                        ->get();

        if (count($tickets) > 0) {
            return response()->json(['comprar' => 'False'], 200);
        } else {
            return response()->json(['comprar' => 'True'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showWithEmailIdSession(Request $request)
    {
        $tickets = Entrada::where('session_id', $request->id)
                            ->where('email', $request->email)
                            ->get();

        if ($tickets->isEmpty()) {
            return response()->json(['message' => 'Entrada no encontrada'], 404);
        } else {
            return response()->json($tickets);
        }
    }

    public function showWithEmail(Request $request)
    {
        $tickets = Entrada::where('email', $request->email)->get();

        if ($tickets->isEmpty()) {
            return response()->json(['message' => 'Entrada no encontrada'], 404);
        } else {
            return response()->json($tickets);
        }
    }

    public function showTotalPurchase($request)
    {
        $tickets = Entrada::where('email', $request['email'])->where('session_id', $request['session_id'])->get();

        if ($tickets->isEmpty()) {
            return response()->json(['message' => 'Entrada no encontrada'], 404);
        } else {
            $total = 0;
            foreach ($tickets as $entrada) {
                $total += $entrada->price;
            }
            return response()->json(['total' => $total], 200);
        }
    }
}
