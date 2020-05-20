<?php

namespace App\Http\Controllers;

use App\Donations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donations = Auth::user()->donations;
        return response()->json([
            'donations'=>$donations
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'pledge' => 'required',
            'message' => 'required'
        ]);
            
        $donations = $request->user()->donations()->create([
            'name' => $request->name,
            'pledge' => $request->pledge,
            'message' => $request->message
        ]);

        return response()->json([
            'donations' => $donations,
            'msg' => 'Donation has been received!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'pledge' => 'required',
            'message' => 'required'
        ]);
            
        $donations = $request->user()->donations()->whereId($id)->update($request->all());

        return response()->json([
            'donations' => $donations,
            'msg' => 'Donation has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donations $donation)
    {
        $donation->delete();

        return response()->json([
            'donations' => $donation,
            'msg' => 'Donation has been deleted'
        ]);
    }
}
