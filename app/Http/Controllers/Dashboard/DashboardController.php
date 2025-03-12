<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Donation;
use App\Models\Transfer;
use App\Models\CharityCase;
use App\Models\CategoryCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Purchase;

class DashboardController extends Controller
{
    public function index()
    {


        $data=[
            "topCategories" => $this->categoryChart(),
            'tansfersToDonations' => $this->transferToDonationsChart(),
            'popularItems' => $this->popularItemsChart(),
            'total_price_doner'=>Donation::get()->sum('price'),
            'total_cases' => CharityCase::get(),
            'total_cases_need'=>CharityCase::where('active',1)->get(),
            'urgent_cases'=>CharityCase::where('active',1)->where('priority','high')->get(),
            'repeating_cases'=>CharityCase::where('active',1)->where('repeating','!=','none')->get(),
            'users' => User::get(),
            'done_cases' => CharityCase::where('active',0)->get(),
            'donationsPerMonth'=>$this->getMonthlyDonations(),
            'donationsCountForThisMonth'=>$this->countDonationForThisMonth(),

            'casesTracker' => $this->casesTrackerChart(),
        ];

        return view('admin.dashboard.index',$data);
    }

    public function categoryChart(){
        $totalCasesCount = CharityCase::count();
        return CategoryCase::withCount('cases')
            ->orderBy('cases_count', 'desc')
            ->limit(6)
            ->get()
            ->map(function ($category,$index) use ($totalCasesCount) {
                $casesCount = $category->cases_count;
                $percentage = $totalCasesCount > 0 ? ($casesCount / $totalCasesCount) * 100 : 0;

                $colors = [
                    'primary',
                    'info',
                    'success',
                    'secondary',
                    'danger',
                    'warning',
                ];

                return [
                    'name' => $category->nameLang(),
                    'percentage' => $percentage,
                    'color' => $colors[$index % count($colors)],
                ];
            });
    }

    public function casesTrackerChart(){
        $doneCasesCount = CharityCase::where('active', 0)->count() ?? 0;
        $archivedCasesCount = CharityCase::where('archive',1)->count() ?? 0;
        // $recycledCasesCount = CharityCase::where('status', 'recycled')->count() ?? 0;

        return [
            'done_cases_count' => $doneCasesCount,
            'archived_cases_count' => $archivedCasesCount,
            // 'recycled_cases_count' => $recycledCasesCount,
        ];
    }

    public function transferToDonationsChart(){
        $maxDonationsPast10Days = Donation::where('created_at', '>=', now()->subDays(10))->max('price');
        $maxTransfersPast10Days = Transfer::where('created_at', '>=', now()->subDays(10))->max('price');

        $donationsPast10Days = Donation::where('created_at', '>=', now()->subDays(10))
                               ->take(10)
                               ->pluck('price')
                               ->toArray();

        $transfersPast10Days = Transfer::where('created_at', '>=', now()->subDays(10))
                                ->take(10)
                                ->pluck('price')
                                ->toArray();

        // Check for null or []
        $maxDonationsPast10Days = $maxDonationsPast10Days ?? 0;
        $maxTransfersPast10Days = $maxTransfersPast10Days ?? 0;
        $donationsPast10Days = !empty($donationsPast10Days) ? $donationsPast10Days : [0,0,0,0,0,0,0,0,0,0];
        $transfersPast10Days = !empty($transfersPast10Days) ? $transfersPast10Days : [0,0,0,0,0,0,0,0,0,0];

        return [
            'maxDonationsPast10Days' => $maxDonationsPast10Days,
            'maxTransfersPast10Days' => $maxTransfersPast10Days,
            'donationsPast10Days' => $donationsPast10Days,
            'transfersPast10Days' => $transfersPast10Days,
        ];
    }

    public function popularItemsChart(){

    }

    public function getMonthlyDonations() {
        $monthlyDonations = Donation::selectRaw('MONTH(created_at) as month, COALESCE(sum(price), 0) as total')
            ->groupBy('month')
            ->get();

        // ترتيب الأشهر
        $donationsPerMonth = array_fill(1, 12, 0); // مصفوفة تحتوي على 12 شهرًا تبدأ من الشهر 1 إلى الشهر 12
        foreach ($monthlyDonations as $donation) {
            // تأكد من أن مجموع التبرعات ليس null
            $donationsPerMonth[$donation->month] = $donation->total ?? 0;
        }

        return array_values($donationsPerMonth);
    }


    public function countDonationForThisMonth(){
           $currentMonth = Carbon::now()->month;
           $currentYear = Carbon::now()->year;

           $donationsCount = Donation::whereMonth('created_at', $currentMonth)
                                     ->whereYear('created_at', $currentYear)
                                     ->count();
    }
    public function ItemsChart(){

        $mostPurchasedProduct = Item::withCount('purchases') 
        ->orderByDesc('purchases_count') 
        ->get(4);

        dd($mostPurchasedProduct);
        
    }
}
