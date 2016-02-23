<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Slot;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', ['data'=>$this->getSlotsData()]);
    }

    private function getSlotsData()
    {
        $result = [];

        $start = Carbon::now();
        $stop = Carbon::now()->addMonth();

        $slots = Slot::where('day', '>=', $start)->where('day', '<', $stop)->orderBy('day', 'asc')->orderBy('hour', 'asc')->orderBy('court', 'asc')->get();

        if ($slots) {
            $current_day = null;
            foreach ($slots as $key => $slot) {
                if (!$current_day || $current_day->day != $slot->day) {
                    if ($current_day) {
                        $result[]=$current_day;
                    }
                    $current_day = new \stdClass();
                    $current_day->day = $slot->day;
                    $current_day->weekday = Carbon::parse($slot->day)->dayOfWeek;
                    $current_day->slots = [];
                }
                $current_day->slots[] = $slot;
            }
            $result[]=$current_day;
        }

        return $result;
    }
}
