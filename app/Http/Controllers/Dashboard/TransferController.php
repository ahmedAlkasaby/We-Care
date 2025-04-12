<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\City;
use App\Models\Region;

use App\Models\Storage;
use App\Models\Transfer;

use App\Models\CharityCase;
use Illuminate\Http\Request;
use App\Traits\TransferTrait;
use App\Http\Controllers\MainController;
use App\Http\Resources\TransferResource;


class TransferController extends MainController
{
    use TransferTrait;



    public function index()
    {
        $transfers=Transfer::with('items','case')->filter(request('search'))->paginate(50);
        $storage=Storage::find(1);
        $transfers_with_items=Transfer::where('type','items')->get();
        $transfers_with_price=Transfer::where('type','price')->get();
        $total_price_for_transfers_with_price=Transfer::where('type', 'price')->sum("price");
        $total_price_for_transfers_with_items=$this->total_price_for_transfers_with_items();
        return view('admin.transfer.index',get_defined_vars());
    }


    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required_without:price|array',
            'items.*.amount' => 'required_without:price|numeric|min:0',
            'price' => 'required_without:items|nullable|numeric|min:1',
        ]);

        if (empty($request->items) && empty($request->price)) {
            return redirect()->back()->withErrors(['validation' =>__('site.you_should_enter_price_or_items')]);
        }

        if (!empty($request->items) && !empty($request->price)) {
            return redirect()->back()->withErrors(['validation' => __('validation.you_cant_enter_both_price_and_items')]);
        }

        if (isset($request->items) && collect($request->items)->filter(function ($item) {
            return isset($item['amount']) && $item['amount'] >= 1;
        })->isEmpty()) {
            return back()->withErrors(['items' => 'يجب أن يكون هناك عنصر واحد على الأقل بكمية صحيحة.'])->withInput();
        }

        if ($request->donation_id) {
            $transfer=Transfer::create([
                'case_id'=>$request->case_id,
                'donation_id'=>$request->donation_id
            ]);
            $case=CharityCase::find($request->case_id);

            if($request->input('items')){
                $this->transferByItemsByDmonation($case->id,$request->input('items'),$transfer->id,$request->donation_id);
            }else{

                $this->transferByPriceByDonation($case->id,$request->price,$transfer->id,$request->donation_id);
            }
        }else{


            $transfer=Transfer::create([
                'case_id'=>$request->case_id
            ]);


            $case=CharityCase::find($request->case_id);

            if($request->input('items')){
                $this->transferByItems($case->id,$request->input('items'),$transfer->id);
            }else{

                $this->transferByPrice($case->id,$request->price,$transfer->id);
            }
        }

        $this->check_archive($case->id);

        session()->flash('success',__('site.createTransfer'));
        return back();


    }







    public function destroy(Transfer $transfer){

        if ($transfer->donation_id) {
            if($transfer->type=='items'){


               $this->deleteTransferByItems($transfer->id,$transfer->donation_id);
            }else{

                $this->deleteTransferByPrice($transfer->id,$transfer->donation_id);
            }
        }else{
            if($transfer->type=='items'){


               $this->deleteTransferByItems($transfer->id);
            }else{

                $this->deleteTransferByPrice($transfer->id);
            }
        }

        session()->flash('success',__('site.deleteTranfer'));
        return back();
    }

    public function show($id){
        $transfer=Transfer::where('id',$id)->first();
        $case = CharityCase::where('id',$transfer->case_id)->first();
        $city = City::where('id',$case->user->city_id)->first();
        $region = Region::where('id',$case->user->region_id)->first();
        return view('admin.transfer.show', get_defined_vars());
    }
}
