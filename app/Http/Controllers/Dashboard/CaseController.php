<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\CaseExport;
use App\Exports\UsersExport;
use App\Http\Controllers\MainController;
use App\Http\Requests\CaseRequest;
use App\Imports\CaseImport;
use App\Imports\UsersImport;
use App\Models\CaseDetail;
use App\Models\Category;
use App\Models\CategoryCase;
use App\Models\CharityCase;
use App\Models\City;
use App\Models\Donation;
use App\Models\Region;
use App\Models\Storage;
use App\Models\Transfer;
use App\Models\User;
use App\Services\CaseService;
use App\Services\SendNotificationService;
use App\Services\UploadImage;
use App\Traits\CaseTrait;
use App\Traits\NotificationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class CaseController extends MainController
{
    use CaseTrait;

    protected $SendNotificationService;
    protected $CaseService;
    protected $UploadImage;

    public function __construct(SendNotificationService $SendNotificationService,CaseService $CaseService ,UploadImage $UploadImage)
    {
        $this->SendNotificationService = $SendNotificationService;
        $this->CaseService = $CaseService;
        $this->UploadImage = $UploadImage;
    }



    public function index(Request $request)
    {
        $total_price_for_case_that_need_price = $this->calculateTotalPriceForCasesNeededMoney();

        $case_that_need_items = CharityCase::where('active', 1)->where('type','items')->get();

        $case_that_need_price = CharityCase::where('active', 1)->where('type','price')->get();

        $total_price_for_case_that_need_items = $this->calculateTotalPriceForCasesNeededItems();

        $cases = CharityCase::with('user','category','items','transfers')->filter(
            $request->search,
            $request->input('volunteer_id'),
            $request->input('category_case_id'),
            $request->input('priority'),
            $request->input('repeating'),
            $request->input('next_donation_date'),
            $request->input('date_end'),
            $request->active,
            $request->input('city_id'),
            $request->input('region_id'),
            $request->input('price'),
            $request->input('price_raised'),
            $request->input('type'),
            $request->input('is_repeated'),
            $request->input('is_event'),
            $request->status
        )->paginate(50);

        if ($request->has('export')) {
            return Excel::download(new CaseExport($cases), 'cases.xlsx');
        }



        $categories = Category::where('active',1)->get();
        $volunteers = User::where('role', 'volunteer')->get();
        $case_categories = CategoryCase::where('active',1)->get();
        $category_array=$this->nameArray($case_categories);
        $cities = City::where('active',1)->with('regions')->get();
        // $regions = Region::get();
        $storage = Storage::find(1);
        $city_array=$this->nameArray($cities);
        // if ($request->ajax()) {
        //     return view('admin.case.includes.table', get_defined_vars())->render();
        // }
        $volunteers=User::where("role","volunteer")->get();
        $volunteersOptions =$this->getVolunteersWithArrayWithFilter();

        return view('admin.case.index', get_defined_vars());
    }


    public function create()
    {
        $categories = Category::where('active',1)->get();
        $volunteers =$this->getVolunteersWithArray();
        $case_categories =CategoryCase::where('active',1)->get();
        $lang=App::getLocale();
        $array=[];
        foreach($case_categories as $value){
            $array[$value->id] = $value->nameLang($lang);
        }
        $case_categories = $array;
        $cities = City::get();
        return view('admin.case.create', get_defined_vars());
    }


    public function store(CaseRequest $request)
    {
        $validatedData = $request->validated();

        // create Case
        $case=$this->CaseService->caseCreateOrEdit($validatedData, $request,'create');

        // count volunteer
        if($request->volunteer_id){

            $this->CaseService->countCasesForVolunteer($request->volunteer_id,'create',$case->id);
        }


        if ($request->hasFile('images')) {
            $this->MultiImages($request->file('images'), $case->id, 'create',$this->UploadImage);
        }

        if ($request->price) {
        } else {
            $this->CaseItems($request->input('items'), $case->id, 'create');
        }

        $this->SendNotificationService->sendNotificationFromCase($case->id,'الرجاء التبرع للحاله','please Donate This Case');

        session()->flash('success', __('site.createCase'));
        return redirect()->route('cases.index');
    }

    public function show($id)
    {
        $case = CharityCase::where('id', $id)->first();
        $city=City::where("id",$case->user->city_id)->first()->nameLang();
        $region=Region::where("id",$case->user->city_id)->first()->nameLang();
        $transfers = Transfer::where('case_id', $id)->paginate();
        $donations = Donation::where('case_id', $id)->get();
        $storage = Storage::find(1);
        $volunteer = User::where('id', $case->volunteer_id)->first();
        $doners = User::where('role', 'doner')->get();
        $voulnteer=User::where("id",$case->volunteer_id )->first();
        $category=CategoryCase::where("id",$case->category_case_id )->first();
        $categories = Category::get();
        $donationsConfirmTotalPrice=$this->donationsConfirmTotalPrice($case->id);
        $donationsPenddingTotalPrice=$this->donationsPenddingTotalPrice($case->id);

        return view('admin.case.show', get_defined_vars());
    }

    public function edit(string $id)
    {
        $case = CharityCase::with(['transfers', 'donations'])->findOrFail($id);


        if ($case->transfers->count() > 0 && $case->donations->count() > 0) {

            session()->flash('error', __('site.you_cant_edit_this_case'));

            return back();
        }

        $categories      = Category::where('active',1)->get();
        $volunteers      = $this->getVolunteersWithArray();
        $case_categories = $this->nameArray(CategoryCase::where('active',1)->get());
        $cities          = City::where('active',1)->get();
        $storage         = Storage::find(1);

        return view('admin.case.edit',get_defined_vars());
    }



    public function update(CaseRequest $request, CharityCase $case)
    {
        if ($case->transfers->count() > 0 && $case->donations->count() > 0) {
            session()->flash('error', ('site.you_cant_edit_this_case'));
            return back();
        };

        $validatedData = $request->validated();

         // update Case
         $case=$this->CaseService->caseCreateOrEdit($validatedData, $request,'update',$case->id);

         // count volunteer
         if ($request->volunteer_id) {
             $this->CaseService->countCasesForVolunteer($request->volunteer_id,'update',$case->id);
         }elseif ($case->volunteer_id) {
            $old_volunteer=User::find($case->volunteer_id);
            $old_volunteer->update([
                'cases' => ($old_volunteer->cases) - 1
            ]);
         }

        if ($request->hasFile('images')) {
            $this->MultiImages($request->file('images'), $case->id, 'update',$this->UploadImage);
        }

        if ($request->price) {
            $case->type="price";
            $case->save();
            $case->items()->detach();
        } else {
            $case->type="items";
            $case->save();
            $this->CaseItems($request->input('items'), $case->id, 'update');
        };

        $this->SendNotificationService->sendNotificationFromCase($case->id,'الرجاء التبرع للحاله','please Donate This Case');

        session()->flash('success', __('site.updateCase'));
        return redirect()->route('cases.index');
    }

    public function active(CharityCase $case)
    {
        $case->update([
            'active' => ! ($case->active),
        ]);

        $total_price_for_case_that_need_price = $this->calculateTotalPriceForCasesNeededMoney();

        $case_that_need_items = CharityCase::where('active', 1)->whereColumn('price_raised', "<", 'price')->whereHas("items")->count();

        $case_that_need_price = CharityCase::where('active', 1)->whereColumn('price_raised', "<", 'price')->whereDoesntHave('items')->count();

        $total_price_for_case_that_need_items = $this->calculateTotalPriceForCasesNeededItems();

        return response()->json([
            'success' => true,
            'active' => $case->active,
            'total_price_for_case_that_need_price'=>$total_price_for_case_that_need_price,
            'case_that_need_items'=>$case_that_need_items,
            'case_that_need_price'=>$case_that_need_price,
            'total_price_for_case_that_need_items'=>$total_price_for_case_that_need_items
        ]);
    }

    public function archive(CharityCase $case){
        $case->update([
            'archive'=>1,
            'active'=>0
        ]);

        Donation::where('case_id',$case->id)->update([
            'archive'=>1
        ]);



        Transfer::where('case_id',$case->id)->update([
            'archive'=>1
        ]);

        return back();

    }

    public function RemoveFromArchive(CharityCase $case){
        $case->update([
            'archive'=>0,
            'active'=>1
        ]);

        Donation::where('case_id',$case->id)->update([
            'archive'=>0
        ]);

        Transfer::where('case_id',$case->id)->update([
            'archive'=>0
        ]);

        return back();
    }

    public function details($id){
        $case = CharityCase::where('id', $id)->first();
        $voulnteer=User::where("id",$case->volunteer_id )->first();
        $category=CategoryCase::where("id",$case->category_case_id )->first();
        return view("admin.case.details",get_defined_vars());
    }


    public function transfer(CharityCase $case){
        $storage = Storage::first();
        if(request()->ajax()) {
            return view("admin.case.includes.transfer", compact('case', 'storage'))->render();
        }
        return abort(404);
    }



    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv'
            ]);

            Excel::import(new CaseImport, $request->file('file'));

            return back()->with('success', __('site.imported_successfully'));

        } catch (\Exception $e) {
            return back()->with('error', __('site.import_failed') );
        }
    }




}
