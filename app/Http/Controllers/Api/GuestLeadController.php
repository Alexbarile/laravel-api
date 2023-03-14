<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

// MODEL
use App\Models\GuestLead;

use App\Mail\GuestContact;

class GuestLeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        // VALIDIAMO 
        $validator = Validator::make($data,
        [
            // prenderli dalla FORM

            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required'

        ]);

        // SE FALLISCE LA VALIDAZIONE

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // ALTRIMENTI PROCEDE AVANTI E SALVA NEL DB LE INFORMAZIONI INSERITE NELLA EMAIL

        $newContact = new GuestLead();
        $newContact->fill($data);

        $newContact->save();

        // Invio di Email
        Mail::to('hello@example.com')->send(new GuestContact($newContact));

        return response()->json([
            'success' => true
        ]);
    }

    
}
