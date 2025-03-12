<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
   
    public function index()
    {
        $payments=Payment::filter(request('search'))->paginate(5);
        return view("admin.payment.index",compact("payments"));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name_en'=>'required',
            'name_ar'=>'required',
        ]);
        Payment::create([
            'name'=>[
                'ar'=>$request->name_ar,
                'en'=>$request->name_en,
            ]
        ]);
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name_en'=>'required',
            'name_ar'=>'required',
        ]);
        $payment=Payment::findOrFail($request->id);
        $payment->update([
            'name'=>[
                'ar'=>$request->name_ar,
                'en'=>$request->name_en,
            ]
        ]);

    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        session()->flash('success',__('site.deletePayment'));
        return back();
    }
}
