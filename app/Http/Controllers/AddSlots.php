<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use App\Slot;

class AddSlots extends Controller
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
        if (Auth::user()->id==1) {
            return view('admin.add');
        }
    }

    public function insert(Request $request)
    {
        if (Auth::user()->id==1) {
            $result = '';

            setlocale(LC_TIME, 'Sweden');

            $start = new Carbon($request->input('start'));
            $stop = new Carbon($request->input('stop'));

            $pos = new Carbon($request->input('start'));
            while ($pos <= $stop) {
                $old_pos = $pos;
                if ($pos->dayOfWeek === Carbon::SATURDAY) {
                    $result .= $this->addSlotsForDay($pos);
                }
                if ($pos->dayOfWeek === Carbon::SUNDAY) {
                    $result .= $this->addSlotsForDay($pos);
                }
                $pos = $pos->addDay();
            }

            return view('admin.add', ['result'=>$result]);
        }
    }

    private function addSlotsForDay(Carbon $day)
    {
        $result = '';
        $courts = [3,4,5,6];
        $hours = [15,16,17,18];
        foreach ($courts as $key => $court) {
            foreach ($hours as $key => $hour) {
                if (!Slot::where('day', $day->toDateString())->where('court', $court)->where('hour', $hour)->count()) {
                    $result.= $day->toDateString() . ', Bana ' . $court . ', kl ' . $hour . ':00 tillagd som slot.<br/>';
                    Slot::create([
                        'day' => $day->toDateString(),
                        'hour' => $hour,
                        'court' => $court,
                    ]);
                }
            }
        }
        return $result;
    }
}
