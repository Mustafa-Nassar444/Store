<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders=Order::paginate();
        return view('dashboard.orders.index',compact('orders'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order){
        $order->delete();
        return redirect()->route('orders.index')->with(['success'=>'Order Deleted!!']);
    }
    public function getTrashed(){
        $orders=Order::onlyTrashed()->paginate();
        return view('dashboard.orders.trash',compact('orders'));
    }
    public function restore(Request $request,$id){
        $order=Order::onlyTrashed()->findOrFail($id);
        $order->restore();
        return redirect()->route('orders.trashed')->with(['success','Order restored Successfully']);

    }
    public function force($id){
        $order=Order::onlyTrashed()->findOrFail($id);
        $order->forceDelete();
        return redirect()->route('orders.trashed')->with(['success'=>'Order Deleted']);
    }

}
