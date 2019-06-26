<?php

namespace App\Http\Controllers;

use App\Contract;
use App\ContractSlub;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transport.contracts.index')
            ->withContracts(Contract::with(['slubs'])->simplePaginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transport.contracts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contract = Contract::create($request->all());

        if ($request->contract_type == 'rates'){

            $data = [];
            $from = $request->from;
            $to = $request->to;
            $charges = $request->charges;
            $t_round = $request->t_round;
            $now = Carbon::now();

            foreach ($from as $key => $value){
                array_push($data,[
                    'contract_id' => $contract->id,
                    'from' => $value,
                'to' => $to[$key],
                'charges' => $charges[$key],
                't_round' => $t_round[$key],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            }

            ContractSlub::insert($data);
        }

        return redirect('/contracts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        return view('transport.contracts.show')
            ->withContract($contract);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        return view('transport.contracts.edit')
            ->withContract($contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        $contract->update($request->all());
        return redirect('/contracts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect('/contracts');
    }
}
