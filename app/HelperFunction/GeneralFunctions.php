<?php

use App\Models\Attendance\NextId;
use App\Models\Auth\UserSystem;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;

function encode_id($id)
{
    return base64_encode(Str::random(30) . '-' . base64_encode($id));
}

function decode_id($id)
{
    $x = base64_decode($id);
    $x = explode('-', $x)[1];
    return base64_decode($x);
}

function to_gregorian($date)
{
    return \Morilog\Jalali\Jalalian::fromFormat('Y-m-d', $date)->toCarbon();
}

function to_jalali($date)
{
    return \Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($date));
}

function uid()
{
    return auth()->user()->id;
}

function dep_id()
{
    return auth()->user()->department_id;
}

function dep_name()
{
    return auth()->user()->dep_details->name;
}

function hasAccessToSystem($system_id)
{
    $user_system = UserSystem::where('user_id', auth()->user()->id)->where('system_id', $system_id)->select('user_id', 'system_id')->first();
    return $user_system == null ? false : true;
}

function currentYear()
{
    return \Morilog\Jalali\CalendarUtils::strftime('Y', strtotime(date('Y')));
}

function can($can)
{
    return auth()->user()->can($can);
}

function get_locale()
{
    return session()->get('locale');
}

function cur_date()
{
    return \Morilog\Jalali\Jalalian::forge('today')->format('Y-m-d');
}

function day_name($date)
{
    $date = new DateTime($date);
    return trans('words.' . $date->format('l'));
}

function countFridays($startDate, $endDate)
{
    $count = 0;

    $start = Carbon::parse($startDate)->startOfDay();
    $end = Carbon::parse($endDate)->endOfDay();

    while ($start <= $end) {
        if ($start->dayOfWeek === Carbon::FRIDAY) {
            $count++;
        }
        $start->addDay();
    }

    return $count;
}

function day_difference($date1, $date2)
{
    $date1 = Carbon::parse($date1);
    $date2 = Carbon::parse($date2);
    return $date1->diffInDays($date2) + 1;
}

function countThursdays($startDate, $endDate)
{
    $start = Carbon::parse($startDate);
    $end = Carbon::parse($endDate);

    $count = 0;

    while ($start <= $end) {
        if ($start->dayOfWeek === Carbon::THURSDAY) {
            $count++;
        }
        $start->addDay();
    }
    return $count;
}

function getNextId()
{
    return NextId::latest()->value('next_id');
}

function setNextId($id)
{
    $lastRecord = NextId::latest()->first();
    $lastRecord->next_id = $id;
    $lastRecord->save();
}
// to get first day of month
function FDOM()
{
    $jalaliDate = Jalalian::now();
    return Jalalian::fromFormat('Y-m-d', $jalaliDate->format('Y-m') . '-01')->format('Y-m-d');
}

// to get last day of month
function LDOM($date = '')
{
    $jalaliDate = Jalalian::now();
    $year = $date == '' ? $jalaliDate->getYear() : explode('-', $date)[0];
    $month = $date == '' ? $jalaliDate->getMonth() : explode('-', $date)[1];
    $lastDayOfMonth = Jalalian::fromFormat('Y-m-d', "{$year}-{$month}-01")->addMonths(1)->subDays(1);
    return $lastDayOfMonth->format('Y-m-d');
}

function officers()
{
    return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 133, 134, 135, 136, 137, 138, 139, 140, 141, 142];
}

function sergeants()
{
    return [11, 12, 13, 127, 128, 129, 143, 144, 145];
}

function patrolmen()
{
    return [14, 15, 130, 131, 146, 147];
}

function civilians()
{
    return [17, 18, 19, 20, 21, 22, 23, 24, 25];
}

function ajeers()
{
    return [26, 27];
}

function ntas()
{
    return 3;
}
function temporaries()
{
    return 4;
}