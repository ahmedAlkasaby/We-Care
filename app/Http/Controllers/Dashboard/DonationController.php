<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Item;
use App\Models\User;
use App\Models\Storage;
use App\Models\Category;

use App\Models\Donation;

use App\Models\CharityCase;
use Illuminate\Http\Request;
use App\Traits\DonationTrait;

use App\Http\Controllers\MainController;
use App\Services\SendNotificationService;

class DonationController extends MainController
{
    use DonationTrait;
    protected $SendNotificationService;

    public function __construct(SendNotificationService $SendNotificationService)
    {
        $this->SendNotificationService = $SendNotificationService;
    }

    public function index()
    {
        $donations=Donation::filter(request('doner_id') == 'kekw' ? '' : request('doner_id'),
         request('price'),request('doner_price'),request('type_donation'),request('case_id'),request('this_year'),request('this_month'))->paginate(50);
        $doners=User::where('role','doner')->get();
        $cases=CharityCase::get();
        $categories=Category::all();
        $storage=Storage::find(1);
        $donations_with_items=Donation::where('confirm',1)->whereHas("items")->get();
        $donations_with_price=Donation::where('confirm',1)->whereDoesntHave("items")->get();
        $total_price_for_items=Donation::where('confirm',1)->whereHas("items")->sum("price");

        $total_price_for_price=Donation::where('confirm',1)->whereDoesntHave("items")->sum("price");

        return view('admin.donation.index',get_defined_vars());
    }

    public function store(Request $request)
    {

        $request->validate([
            'doner_id' => 'required|exists:users,id',
            'case_id' => 'nullable|exists:charity_cases,id',
            'items' => 'required_without:price|array',
            'items.*.item_id' => 'required_without:price|exists:items,id',
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

        if($request->price){
            $this->donationByPrice($request->doner_id,$request->price,$request->case_id);
        }else{
           $this->donationByItems($request->doner_id,$request->input('items'),$request->case_id);
        }
        session()->flash('success',__('site.createDonation'));
        return back();

    }

    public function confirm(Request $request){
        $request->validate([
            'type'=>"required|in:items,price",
            'items'=>'required_if:type,items',
            'items.*.item_id' => 'required_if:type,items|exists:items,id',
            'items.*.amount' => 'required_if:type,items|numeric|min:0',
        ]);
        $items=$request->input('items') ? $request->input('items') : null;
        $donation=Donation::find($request->id);
        $this->confirmDonation($donation->id, $items);

        $this->SendNotificationService->sendNotificationFromConfirmDonation($donation->id,'تم التاكيد علي تبرعك بنجاح ','Donation Confirmed Successfully');

       $this->addDonateMoneyToDoner($donation->id);


        session()->flash('success',__('site.confirmedDonation'));
        return back();
    }

    public function destroy(Donation $donation)
    {
        if($donation->confirm==false){
            $donation->delete();
            session()->flash('success',__('site.deleteDonation'));
        }
        else{
            session()->flash('error',__('site.canNotDeleteDonation'));
        }
        return redirect()->route("donations.index");
    }


    public function show(Donation $donation){
        $categories=Category::all();
        $items=Item::all();
        return view('admin.donation.show',compact('donation','categories','items'));
    }
}
