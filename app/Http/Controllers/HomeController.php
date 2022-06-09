<?php

namespace App\Http\Controllers;


use App\HoaDon;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function index(){
        $sale = HoaDon::select(DB::raw('SUM(tienphong) as total'))
            ->whereYear("created_at", date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck("total");
        $sale_year = HoaDon::select(DB::raw('SUM(tienphong) as total'))
            ->whereYear("created_at", date('Y'))
            ->groupBy(DB::raw("Year(created_at)"))
            ->pluck("total");
        $months = HoaDon::select(DB::raw('Month(created_at) as month'))
            ->whereYear("created_at", date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck("month");
        $datas = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($months as $index => $month) {
            $datas[$month] = (int)$sale[$index];
        }

        return view('admin.dashboard.dashboard', compact('datas', 'sale_year'));
    }

    /**
     * @param $language
     * @return RedirectResponse
     */
    public function changeLanguage($language): RedirectResponse
    {
        App::setLocale($language);
        session()->put('locale', $language);

        return redirect()->back();
    }
}
