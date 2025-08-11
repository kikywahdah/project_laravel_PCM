<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;
use App\Models\Usaha;
use App\Models\Modal;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAset = Aset::count();
        $totalUsaha = Usaha::count();
        $totalModal = Modal::count();
        $totalNilaiModal = Modal::sum('jumlah');

        $counts = [
            'Aset' => $totalAset,
            'Usaha' => $totalUsaha,
            'Modal' => $totalModal,
        ];
        $totalSemua = array_sum($counts);

        $sortedDesc = $counts;
        arsort($sortedDesc);
        $topName = array_key_first($sortedDesc);
        $topValue = $sortedDesc[$topName];

        $sortedAsc = $counts;
        asort($sortedAsc);
        $bottomName = array_key_first($sortedAsc);
        $bottomValue = $sortedAsc[$bottomName];

        $percentages = [];
        foreach ($counts as $name => $value) {
            $percentages[$name] = $totalSemua > 0 ? round(($value / $totalSemua) * 100) : 0;
        }

        return view('dashboard', compact(
            'totalAset', 'totalUsaha', 'totalModal', 'totalNilaiModal',
            'counts', 'totalSemua', 'percentages', 'topName', 'topValue', 'bottomName', 'bottomValue'
        ));
    }
} 