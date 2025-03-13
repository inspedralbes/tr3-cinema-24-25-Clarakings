<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sessions;


class SessionsController extends Controller
{
    public function index()
    {
        $sessions = Sessions::all();

        return response()->json($sessions);
    }

    public function create(Request $request)
    {
        $fildsets = $request->validate([
            'day' => 'required|unique:sessions',
            'hour' => 'required',
            'movie_id'=> 'required',
            'audienceDay' => 'boolean',
            'priceBase' => 'numeric',
        ]);

        if (Sessions::where('day', $fildsets["day"])->exists()) {
            return response()->json(['message' => 'Session already exists'], 400);
        } else if ($fildsets["day"] < date("Y-m-d")) {
            return response()->json(['message' => 'Invalid date'], 400);
        }

        $session = new Sessions();

        $session["day"] = $fildsets["day"];
        $session["hour"] = $fildsets["hour"];
        $session["movie_id"] = $fildsets["movie_id"];

        if ($fildsets["audienceDay"] && !$fildsets["priceBase"]) {
            $session["audienceDay"] = $fildsets["audienceDay"];
            $session["priceBase"] = 4.00;
        } else if ($fildsets["priceBase"] && !$fildsets["audienceDay"]) {
            $session["priceBase"] = $fildsets["priceBase"];
        } else if ($fildsets["audienceDay"] && $fildsets["priceBase"]) {
            $session["audienceDay"] = $fildsets["audienceDay"];
            $session["priceBase"] = $fildsets["priceBase"];
        }

        if (isset($fields['vip'])) {
            $session["vip"] = $fildsets["vip"];
        }

        if ($session->save()) {
            // Session saved successfully
            return response()->json(['message' => 'NEW Session created successfully'], 200);
        } else {
            // Failed to save the session
            return response()->json(['message' => 'Failed to create the NEW Session'], 500);
        }
    }

    public function show(Request $request)
    {
        $session = Sessions::where('id_session', $request->id)->first();

        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        } else {
            return response()->json($session);
        }
    }

    public function getByMovieId(Request $request)
    {
        $session = Sessions::where('movie_id', $request->id)->first();

        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        } else {
            return response()->json($session);
        }
    }

    public function update(Request $request)
    {
        $fildsets = $request->validate([
            'day' => 'required',
            'hour' => 'required',
            'movie_id'=> 'required',
            'audienceDay' => 'boolean',
            'priceBase' => 'numeric',
        ]);

        $session = Sessions::where('id_session', $request->id)->first();

        $session->day = $fildsets["day"];
        $session->hour = $fildsets["hour"];
        $session->movie_id = $fildsets["movie_id"];

        if ($fildsets["audienceDay"] && !$fildsets["priceBase"]) {
            $session->audienceDay = $fildsets["audienceDay"];
            $session->priceBase = 4.00;
        } else if ($fildsets["priceBase"] && !$fildsets["audienceDay"]) {
            $session->priceBase = $fildsets["priceBase"];
        } else if ($fildsets["audienceDay"] && $fildsets["priceBase"]) {
            $session->audienceDay = $fildsets["audienceDay"];
            $session->priceBase = $fildsets["priceBase"];
        }

        if (isset($fields['vip'])) {
            $session->vip = $fildsets["vip"];
        }

        if ($session->save()) {
            // Session updated successfully
            return response()->json(['message' => 'Session updated successfully'], 200);
        } else {
            // Failed to update the session
            return response()->json(['message' => 'Failed to update the session'], 500);
        }
    }

    public function destroy($id)
    {
        $session = Sessions::find($id);
        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        }
        if ($session->delete()) {
            // Session deleted successfully
            return response()->json(['message' => 'Session deleted successfully'], 200);
        } else {
            // Failed to delete the session
            return response()->json(['message' => 'Failed to delete the session'], 500);
        }
    }
}
