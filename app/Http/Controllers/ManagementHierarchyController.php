<?php

namespace App\Http\Controllers;

use App\Models\CustomerManagement;
use App\Models\ManagementHierarchie;
use Illuminate\Http\Request;

class ManagementHierarchyController extends Controller
{
    public static function placeTicketInHierarchy($request)
    {
//        CustomerManagement::where('id', $request->id)->update([
//            'comment' => !is_null($request->comment) ? $request->comment : '',
//        ]);
//        CustomerManagement::where('id', $request->id)->delete();
        CustomerManagementController::delete($request->id);
        CustomerManagementController::find($request->id);
//        $deletedTicket = CustomerManagement::withTrashed()->find($request->id);

//        ManagementHierarchyController::createTicketInHierarchy($deletedTicket);
    }

    public static function createTicketInHierarchy($ticket)
    {
        ManagementHierarchie::create([
            'fk_employee_id' => $ticket->fk_employee_id,
            'fk_customer_id' => $ticket->fk_customer_id,
            'fk_ticket_id' => $ticket->fk_ticket_id,
            'fk_keyword_id' => $ticket->fk_keyword_id,
            'closed' => !is_null($ticket->closed) ? 1 : 0,
            'response' => !is_null($ticket->response) ? $ticket->response : '',
            'satisfied' => !is_null($ticket->satisfied) ? 1 : 0,
            'comment' => !is_null($ticket->comment) ? $ticket->comment : '',
            'assignment_at' => $ticket->assignment_at,
            'expiry_at' => $ticket->expiry_at,
            'replied_at' => !is_null($ticket->replied_at) ? $ticket->replied_at : '',
        ]);
    }
}
