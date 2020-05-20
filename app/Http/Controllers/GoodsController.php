<?php

namespace App\Http\Controllers;
use App\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = Auth::user()->goods;
        return response()->json([
            'goods' => $goods
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'good' => 'required',
            'quantity' => 'required',
            'district' => 'required'
        ]);

        $goods = $request->user()->goods()->create([
            'good' => $request->good,
            'quantity' => $request->quantity,
            'district' => $request->district
        ]);

        return response()->json([
            'goods' => $goods,
            'message' => 'Relief Good has been recorded'
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
            'good' => 'required',
            'quantity' => 'required',
            'district' => 'required'
        ]);

        $goods = $request->user()->goods()->whereId($id)->update($request->all());

        return response()->json([
            'goods' => $goods,
            'message' => 'Relief Good details have been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goods $good)
    {
        $good->delete();

        return response()->json([
            'goods' => $good,
            'message' => 'Relief Good has been removed'
        ]);
    }
}
