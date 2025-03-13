<?php

use App\Http\Controllers\Dashboard\AdminController;

use App\Http\Controllers\Dashboard\CaseController;
use App\Http\Controllers\Dashboard\CategoryCaseController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DonationController;
use App\Http\Controllers\Dashboard\DonerController;
use App\Http\Controllers\Dashboard\FaqController;
use App\Http\Controllers\Dashboard\ImpactController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\MessageController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\PurchaseController;
use App\Http\Controllers\Dashboard\RegionController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\StorageController;
use App\Http\Controllers\Dashboard\TransferController;
use App\Http\Controllers\Dashboard\VolunteerController;
use App\Http\Controllers\MainController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('test',function(){
    if (php_sapi_name() === 'cli') {
        die('This script should not be run from the command line.');
    }

    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');

    return "Cache cleared successfully";
});





Route::get('/', function () {
    if(Auth::user()){
        return redirect()->route('admin');
    }
    return view('auth.login');
})->name("auth");

Auth::routes([
    'register'=>false
]);

Route::get('/a',function(){
    return "wjshdf";
});







Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/change/lang',[MainController::class, 'lang'])->name('change.lang');
Route::get('/change/theme',[MainController::class, 'theme'])->name('change.theme');





Route::group(['prefix'=>'dashboard','middleware' => ['auth','is_admin', 'setUserLocale','global_permission']], function(){
    Route::get('/clear-cache',[MainController::class,'clearCache'])->name('clear.cache');
    Route::get('/data_table',function(Request $request){
        if ($request->ajax()) {
            $categories = Category::latest();

            return DataTables::of($categories)
                ->addIndexColumn() // إضافة ترقيم تلقائي
                ->addColumn('actions', function ($category) {
                    return view('admin.category.includes.actions', compact('category'))->render();
                })
                ->addColumn('status', function ($category) {
                    return view('admin.category.includes.status', compact('category'))->render();
                })
                ->editColumn('name', function ($category) {
                    return $category->nameLang();
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }

        return view("data_table");
    });
    Route::get('/',[DashboardController::class, 'index'])->name('admin');
    //roles
    Route::resource('roles',RoleController::class)->except('show');
    Route::get('roles/toggle/{role}',[MainController::class,'toggle'])->name('roles.toggle');
    //admin
    Route::resource('admins',AdminController::class)->except('show');
    //volunteer
    Route::resource('volunteers',VolunteerController::class);
    //doner
    Route::resource('doners',DonerController::class);
    Route::get('profile/security/{id}', [DonerController::class, 'security'])->name('doners.security');
    Route::post('profile/security/updatePassword/{id}', [DonerController::class, 'updatePassword'])->name("changePass");
    //category
    Route::resource('categories',CategoryController::class)->except('show');
    Route::get('categories/toggle/{category}',[MainController::class,'toggle'])->name('categories.toggle');
    //category cases
    Route::resource('category_cases',CategoryCaseController::class)->except('show');
    Route::get('category_cases/toggle/{category}',[MainController::class,'toggle'])->name('category_cases.toggle');
    //item
    Route::resource('items',ItemController::class)->except('show');
    Route::get('items/toggle/{item}',[MainController::class,'toggle'])->name('items.toggle');
    //case
    Route::resource('cases',CaseController::class)->except('destroy');
    Route::get('cases/toggle/{case}',[CaseController::class,'active'])->name('cases.toggle');
    Route::get('cases/archive/{case}',[CaseController::class,'archive'])->name('cases.archive');
    Route::get('cases/remove-from-archive/{case}',[CaseController::class,'RemoveFromArchive'])->name('cases.RemoveFromArchive');
    Route::get('cases/tranfer/{case}',[CaseController::class,'transfer'])->name('cases.transfer');
    Route::post('cases/import', [CaseController::class, 'import'])->name('cases.import');
    //donation
    Route::resource('donations',DonationController::class);
    Route::post('donations/confirm/{donation}',[DonationController::class,'confirm'])->name('donations.confirm');

    Route::resource('purchases',PurchaseController::class)->except('delete','show');


    Route::resource('transfers',TransferController::class);
    Route::resource('payments',PaymentController::class)->except('show');
    Route::get('storage',[StorageController::class,'show'])->name('storage.index');



    Route::resource('profile', ProfileController::class)->except('create','store','edit','show');
    Route::get('profile/security', [ProfileController::class, 'security'])->name('profile.security');
    Route::post('profile/security/updatePassword', [ProfileController::class, 'updatePassword']);
    Route::resource('settings', SettingController::class)->except('index','show','destroy','create');

    // regions
    Route::resource('regions',RegionController::class);
    Route::get('regions/toggle/{region}',[MainController::class, 'toggle'])->name('regions.toggle');
    //cities
    Route::resource('cities',CityController::class);
    Route::get('cities/toggle/{city}',[MainController::class,'toggle'])->name('cities.toggle');

    Route::get('translations', [Barryvdh\TranslationManager\Controller::class, 'getIndex'])->name('translations');


    // sliders
    Route::resource("sliders",SliderController::class)->except("show");
    Route::get('sliders/toggle/{slider}',[MainController::class,'toggle'])->name('sliders.toggle');
    Route::get('sliders/trash',[SliderController::class,'deleted'])->name('sliders.deleted');
    Route::get('sliders/{slider}/restore', [SliderController::class, 'restore'])->name('sliders.restore');

    //impacts
    Route::resource("impacts",ImpactController::class)->except("show");
    Route::get('impacts/toggle/{impact}',[MainController::class,'toggle'])->name('impacts.toggle');
    Route::get('impacts/trash',[ImpactController::class,'deleted'])->name('impacts.deleted');
    Route::post('impacts/{impact}/restore', [ImpactController::class, 'restore'])->name('impacts.restore');


    // pages
    Route::resource("pages",PageController::class)->except("show");
    Route::get('pages/toggle/{page}',[MainController::class,'toggle'])->name('pages.toggle');
    Route::get('pages/trash',[PageController::class,'deleted'])->name('pages.deleted');
    Route::post('pages/{page}/restore', [PageController::class, 'restore'])->name('pages.restore');

    // messages
    Route::resource("messages", MessageController::class);
    Route::post("messages/send/{id}", [MessageController::class, "sendMessage"])->name("messages.sendMessage");

    // faqs
    Route::resource("faqs",FaqController::class)->except('show');
    Route::get('faqs/toggle/{faq}',[MainController::class,'toggle'])->name('faqs.toggle');
    Route::get('faqs/trash',[FaqController::class,'deleted'])->name('faqs.deleted');
    Route::post('faqs/{faq}/restore', [FaqController::class, 'restore'])->name('faqs.restore');

    // notifications
    Route::resource("notifications",NotificationController::class)->except("show");
    Route::put("notifications/{notification}/makeAsRead",[NotificationController::class,'makeAsRead'])->name('notifications.markAsRead');


});


