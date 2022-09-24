<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicketRequest;
use App\Models\Participant;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function create(CreateTicketRequest $req)
    {
        $input = $req->all();

        try {
            DB::beginTransaction();

            $participant = Participant::create([
                'name' => $input['name'],
                'ticket' => $this->generateTicket(8),
                'numbers' => json_encode($input['numbers']),
            ]);

            if ($participant) {
                DB::commit();

                return response()->json(['ticketCode' => $participant->ticket]);
            }

            DB::rollBack();

            return response()->json(['error' => 'Error ao salvar o participante!'], 400);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json(['error' => 'Error ao salvar o participante!'], 400);
        }
    }

    public function generateTicket($qntCaraceters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        $specialCharacters = str_shuffle('!@#$%*-');

        $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;

        $ticket = substr(str_shuffle($characters), 0, $qntCaraceters);

        return $ticket;
    }
}
