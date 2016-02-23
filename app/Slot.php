<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $fillable = ['day','hour','court'];
    protected $appends = ['weekday','weekday_title'];

    public function getWeekdayAttribute($value)
    {
        return \Carbon\Carbon::parse($this->day)->dayOfWeek;
    }

    public function getWeekdayTitleAttribute($value)
    {
        $result = '';
        $weekday = \Carbon\Carbon::parse($this->day)->dayOfWeek;
        // development server miss the sv_SE.UTF-8 locale install :-(
        switch ($weekday) {
            case 1: $result='Måndag'; break;
            case 2: $result='Tisdag'; break;
            case 3: $result='Onsdag'; break;
            case 4: $result='Torsdag'; break;
            case 5: $result='Fredag'; break;
            case 6: $result='Lördag'; break;
            case 0: $result='Söndag'; break;
        }
        return $result;
    }
}
