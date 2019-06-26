<?php

namespace App\Http\Controllers;

use App\Mail\ApprovalRequest;
use App\Mail\QuotationUpdate;
use App\Quotation;
use Esl\helpers\Constants;
use Esl\Repository\AgencyRepo;
use Esl\Repository\NotificationRepo;
use Esl\Repository\QuotationRepo;
use Esl\Repository\RemarkRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AgencyApprovalController extends Controller
{
    public function approve(Request $request)
    {
        $quotation = Quotation::with(['user'])->findOrFail($request->quotation_id);

        if ($quotation->status == Constants::LEAD_QUOTATION_REQUEST) {
            $status = Constants::LEAD_QUOTATION_CHECKED;
            $quotation->checked_by = Auth::user()->id;
            $message = "Your quotation has been Checked by ";

            Mail::to(['email' => 'maurine.atieno@esl-eastafrica.com'])
                ->cc(Constants::EMAILS_CC)
                ->send(new ApprovalRequest([
                    'user' => Auth::user()->name,
                    'url' => '/quotation/view/' . $request->quotation_id], 'Approval Request'));

        } else {
            $status = Constants::LEAD_QUOTATION_APPROVED;
            $quotation->approved_by = Auth::user()->id;
            $message = "Your quotation has been Approved by ";
        }

        QuotationRepo::make()->changeStatus($request->quotation_id,
            $status);

        Mail::to($quotation->user->email)
            ->cc(Constants::EMAILS_CC)
            ->send(new QuotationUpdate([
                'url' => '/quotation/' . $quotation->id,
                'message' => $message . ucwords(Auth::user()->name)]));

        $quotation->save();

        self::updates([
            'quotation_id' => $request->quotation_id,
            'user_id' => $quotation->user_id,
            'remarks' => $request->remarks,
        ], 'Approved');

        alert()->success('Success', 'Successfully approved');

        return Response(['success' => 'Approved']);
    }

    public function revision(Request $request)
    {
        $quotation = Quotation::findOrFail($request->quotation_id);
        QuotationRepo::make()->changeStatus($request->quotation_id,
            Constants::LEAD_QUOTATION_DECLINED);

        NotificationRepo::create()->notification(Constants::Q_DISAPPROVED_TITLE,
            Constants::Q_DISAPPROVED_TEXT,
            '/quotation/'.$request->quotation_id,0,'Agency', $quotation->user_id);

        self::updates([
            'quotation_id' => $request->quotation_id,
            'user_id' => $quotation->user_id,
            'remarks' => $request->remarks
        ], 'Disapproved');

        return Response(['success' => 'Revision']);
    }

    private function updates($data, $action){
        AgencyRepo::make()->quotationApproval([
            'user_id' => Auth::user()->id,
            'quotation_id' => $data['quotation_id'],
            'quotation_action' => $action,
            'remarks' => $data['remarks'] == null ? '' : $data['remarks']
        ]);

        if ($data['remarks']){
        RemarkRepo::make()->remark([
            'user_id' => Auth::user()->id,
            'remark_to' => $data['user_id'],
            'quotation_id' => $data['quotation_id'],
            'remark' => $data['remarks']
        ]);
        }
    }
}
