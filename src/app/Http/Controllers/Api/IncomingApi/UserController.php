<?php

namespace App\Http\Controllers\Api\IncomingApi;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Gateway;
use App\Models\EmailLog;
use App\Jobs\ProcessEmail;
use Illuminate\Support\Arr;
use App\Models\EmailContact;
use App\Models\EmailGroup;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Service\CustomerService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmailLogResource;
use App\Http\Requests\ApiStoreEmailRequest;
use App\Http\Resources\GetEmailLogResource;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function getContacts(): JsonResponse
    {
        $emailContacts = EmailContact::all();
        if(!$emailContacts){
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid Email Log uid'
            ],404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $emailContacts,
        ],201);
    }

    public function getContact($id): JsonResponse
    {
        $emailContacts = EmailContact::where('id', $id)->get();
        if(!$emailContacts){
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid Email Log uid'
            ],404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $emailContacts,
        ],201);
    }

    public function addContact(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email_group_id' => 'required|int|exists:email_groups,id',
                'email'          => 'required|email|unique:email_contacts,email',
                'name'           => 'required',
                'birthdate'      => 'nullable|date_format:d/m/Y',
                'city'           => 'nullable',
                'status'         => 'required|in:1,2',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->validator->errors()->first()], 422);
        }

        $birthdate    = $request->birthdate ? Carbon::createFromFormat('d/m/Y', $request->birthdate)->format('Y-m-d') : null;
        $emailContact = EmailContact::create([
            'user_id'        => null,
            'email_group_id' => $request->email_group_id,
            'email'          => $request->email,
            'name'           => $request->name,
            'birthdate'      => $birthdate,
            'city'           => $request->city,
            'status'         => $request->status,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Email Contact created successfully',
            'data'    => $emailContact,
        ],201);
    }

    public function editContact(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'email_group_id' => 'required|int|exists:email_groups,id',
                'email'          => 'required|email|unique:email_contacts,email,' . $id,
                'name'           => 'required',
                'birthdate'      => 'nullable|date_format:d/m/Y',
                'city'           => 'nullable',
                'status'         => 'required|in:1,2',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->validator->errors()->first()], 422);
        }

        $birthdate = $request->birthdate ? Carbon::createFromFormat('d/m/Y', $request->birthdate)->format('Y-m-d') : null;

        $emailContact = EmailContact::find($id);

        if (!$emailContact) {
            return response()->json(['status' => 'error', 'message' => 'Contact not found'], 404);
        }

        $emailContact->update([
            'email_group_id' => $request->email_group_id,
            'email'          => $request->email,
            'name'           => $request->name,
            'birthdate'      => $birthdate,
            'city'           => $request->city,
            'status'         => $request->status,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Email Contact updated successfully',
            'data'    => $emailContact,
        ], 200);
    }

    public function deleteContact($id): JsonResponse
    {
        $emailContact = EmailContact::find($id);

        if (!$emailContact) {
            return response()->json(['status' => 'error', 'message' => 'Contact not found'], 404);
        }

        $emailContact->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Email Contact deleted successfully',
        ], 200);
    }
}
