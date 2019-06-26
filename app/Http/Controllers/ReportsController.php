<?php

namespace App\Http\Controllers;

use App\BillOfLanding;
use App\Lead;
use App\PurchaseOrder;
use Esl\Repository\ReportsRepo;
use Illuminate\Http\Request;
use Excel;
use PDF;
class ReportsController extends Controller
{


    public function create()
    {
        return view('reports.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = $request->get('status');
        $jobs = '';
        if ($status=='all') {
            $jobs = BillOfLanding::whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();
        }
        elseif ($status=='active'){
            $jobs = BillOfLanding::where('status',0)->whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();
        }
        elseif ($status=='completed'){
            $jobs = BillOfLanding::where('status',1)->whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();
        }

        $from = date('d-m-Y',strtotime($request->get('from')));
        $to = date('d-m-Y',strtotime($request->get('to')));

        return view('reports.jobs.index')->with('jobs', $jobs)->with('from',$from)->with('to',$to)->with('status',$status);
    }

    public function exportPDF($from,$to,$status,$type)

    {
        $date_from = date('m/d/Y',strtotime($from));
        $date_to = date('m/d/Y',strtotime($to));
        $jobs = '';
        if ($status=='all') {
            $jobs = BillOfLanding::whereBetween('created_at', [$date_from, $date_to])->get();
        }
        elseif ($status=='active'){
            $jobs = BillOfLanding::where('status',0)->whereBetween('created_at', [$date_from, $date_to])->get();
        }
        elseif ($status=='completed'){
            $jobs = BillOfLanding::where('status',1)->whereBetween('created_at', [$date_from, $date_to])->get();
        }

        if ($type !='pdf') {
            return $this->downloadJob($date_from, $date_to, $status, $type);
        }

        $pdf = PDF::loadView('reports.jobs.generate-pdf',compact('jobs'));
        return $pdf->download('jobs.pdf');

    }
    private function downloadJob($date_from,$date_to,$status,$type){

        $data = ReportsRepo::init()->getJobs($date_from,$date_to,$status);
        return Excel::create('jobs', function ($excel) use ($data) {

            $excel->sheet('mySheet', function ($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->download($type);
    }

    public function posReport()
    {
        return view('reports.pos.create');
    }

    public function getPos()
    {
        $status = request()->get('status');
        $pos = '';
        if ($status=='requested'){
            $pos = PurchaseOrder::where('status','requested')->whereBetween('created_at', [request()->get('from'), request()->get('to')])->get();
        }
        elseif ($status=='approved'){
            $pos = PurchaseOrder::where('status','approved')->whereBetween('created_at', [request()->get('from'), request()->get('to')])->get();
        }PurchaseOrder::where('status','requested')->whereBetween('created_at', [$date_from, $date_to])->get();

        $from = date('d-m-Y',strtotime(request()->get('from')));
        $to = date('d-m-Y',strtotime(request()->get('to')));
        return view('reports.pos.index')->with('pos', $pos)->with('from',$from)->with('to',$to)->with('status',$status);
    }

    public function exportPo($from,$to,$status,$type)
    {


        $date_from = date('m/d/Y',strtotime($from));
        $date_to = date('m/d/Y',strtotime($to));
        $pos = '';
        if ($status=='requested'){
            $pos = PurchaseOrder::where('status','requested')->whereBetween('created_at', [$date_from, $date_to])->get();
        }
        elseif ($status=='approved'){
            $pos = PurchaseOrder::where('status','approved')->whereBetween('created_at', [$date_from, $date_to])->get();
        }

        if ($type !='pdf') {
            return $this->downloadPo($date_from, $date_to, $status, $type);
        }

        $pdf = PDF::loadView('reports.pos.generate-pdf',compact('pos'));
        return $pdf->download('pos.pdf');
    }

    private function downloadPo($date_from,$date_to,$status,$type)
    {

        $data = ReportsRepo::init()->getPos($date_from,$date_to,$status);
        return Excel::create('pos', function ($excel) use ($data) {

            $excel->sheet('mySheet', function ($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->download($type);
    }

    public function mypos()
    {
        $data = ReportsRepo::init()->oldPos();
        return Excel::create('Updated_Project_Codes', function ($excel) use ($data) {

            $excel->sheet('mySheet', function ($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->download('xls');
   }
    public function leadsReport()
    {
        return view('reports.leads.create');
    }

    public function getLeads()
    {


        $leads = Lead::whereBetween('created_at', [request()->get('from'), request()->get('to')])->get();
        $from = date('d-m-Y',strtotime(request()->get('from')));
        $to = date('d-m-Y',strtotime(request()->get('to')));
        return view('reports.leads.index')->with('leads', $leads)->with('from',$from)->with('to',$to);
    }

    public function exportLead($from,$to,$type)
    {
        $date_from = date('m/d/Y',strtotime($from));
        $date_to = date('m/d/Y',strtotime($to));

        if ($type !='pdf') {
            return $this->downloadLeads($date_from, $date_to,$type);
        }
        $leads = Lead::whereBetween('created_at', [$date_from, $date_to])->get();
        $pdf = PDF::loadView('reports.leads.generate-pdf', compact('leads'));
        return $pdf->download('leads.pdf');
    }

    private function downloadLeads($date_from,$date_to,$type)
    {
        $data = ReportsRepo::init()->getLeads($date_from,$date_to);
        return Excel::create('leads', function ($excel) use ($data) {

            $excel->sheet('mySheet', function ($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->download($type);
    }
}
