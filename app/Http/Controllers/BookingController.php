<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
use App;
use Session;
use Config;
use Illuminate\Support\Facades\Input;

class BookingController extends Controller
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
        $treners = App\Trener::all();
        return view('booking', ['treners' => $treners]);
    }


    /**
     * Store new order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $timeRequest = $request->input('timeList');
        $timeOrder = [];

        if (isset($timeRequest)) {
            foreach ($timeRequest as $key => $val) {
                if ($key != 'agree' && $key != 'paid') {
                    $timeOrder[] = $key;
                }
            }
        }


        if (Auth::check()) {

            if (empty($request->input('phone'))) {
                $request['phone'] = Auth::User()->phone;
            }

            if (empty($request->input('email'))) {
                $request['email'] = Auth::User()->email;
            }

            $v = Validator::make($request->all(), [
                'description' => 'required|max:255',
                'type' => 'required',
                'room' => 'required',
                'phone' => 'required|phone:AUTO,UA',
                'email' => 'required',
                'timeList' => 'required',
            ]);
            $forFoom = $request->input('room');
            $this->timeUse($timeOrder, $v, $forFoom);

            if ($v->fails()) {
                return $v->errors();
            }
            $this->storeAuth($request, $timeOrder);

        } else {
            $request['phone'] = ltrim($request->input('phone'), '+');
            $v = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required|max:255',
                'phone' => 'required|phone:AUTO,UA',
                'type' => 'required',
                'room' => 'required',
                'email' => 'required',
                'timeList' => 'required'
            ]);

            $forFoom = $request->input('room');
            $this->timeUse($timeOrder, $v, $forFoom);

            if ($v->fails()) {
                return $v->errors();
            }

            $this->storeNoAuth($request, $timeOrder);
        }
        return response()->json('Thanks for create!');
    }


    /**
     * @param Request $request
     */
    private function storeAuth(Request $request, $timeOrder)
    {

        $room = $this->getRoomId($request);

        if($_POST['type2'] == "fix"){
            $weeks = [];
            $cost = 250;
            foreach ($timeOrder as $time){
                $nextWeek = date(strtotime("+1 week", $time));
                $nextWeek2 = date(strtotime("+1 week", $nextWeek));
                $nextWeek3 = date(strtotime("+1 week", $nextWeek2));

                $weeks[] = $time;
                $weeks[] = $nextWeek;
                $weeks[] = $nextWeek2;
                $weeks[] = $nextWeek3;
            }
            $timeOrder = $weeks;
            $cost = $this->extraCost($timeOrder, $cost);
            if(count($timeOrder) == 8){
                $cost = $cost * 2;
            }
        }

        if($_POST['type2'] == "no-fix"){
            $cost = 300;
            $cost = $this->extraCost($timeOrder, $cost);
            if(count($timeOrder) == 8){
                $cost = $cost * 2;
            }
        }



        $strTime = "";
        $totalSumm = 0;

        if($_POST['type2'] == "no-fix" || $_POST['type2'] == "fix"){
                $totalSumm = $cost;
        } else {
            foreach ($timeOrder as $val) {
                $strTime = $strTime . date('Y-m-d: H ', $val) . "-" . date('H', strtotime("+1 hour", $val)) . "<br>";
                $totalSumm += $this->getTimeCost($val, $request->input('type'));
            }
        }





        if(isset($request->paid)){
            $paid = 1;
        } else {
            $paid = 0;
        }

        $phone = $_POST['phone'];

        DB::transaction(function () use ($timeOrder, $room, $strTime, $request, $totalSumm, $paid, $phone) {
            $order = Order::create([
                'type' => Input::get('type'),
                'room' => Input::get('room'),
                'time' => Input::get('time'),
                /*'name' => Auth::User()->name,*/
                'name' =>  Input::get('name'),
                'phone' => $phone,
                'email' => Input::get('email'),
                'card_number' => Input::get('card_number'),
                'description' => Input::get('description'),
                'agree' => 1,
                'total_summ' => $totalSumm,
                /*'user_id' => Auth::User()->id,*/
                'user_id' => 0,
                'str_text' => $strTime,
                'is_paid' => $paid,
                'type2' => $_POST['type2'],
                'trener_name' => $_POST['trener_name']
            ]);
            $arrayInsert = [];
            foreach ($timeOrder as $val) {
                $costTime = $this->getTimeCost($val, $request->input('type'));
                $getTimeCount = App\Time::where('time', '=', $val)->where('room_id', '=', $room)->first();
                if(isset($getTimeCount)){
                    $getTimeCount->count = $getTimeCount->count + 1;
                    $getTimeCount->save();
                } else {
                    $getTimeCount = 1;
                    $arrayInsert[] = [
                        'order_id' => $order->id,
                        'time' => $val,
                        'room_id' => $room,
                        'user_id' => Auth::User()->id,
                        'cost' => $costTime,
                        'count' => $getTimeCount,
                    ];
                }
            }

            DB::table('times')->insert($arrayInsert);
        });

    }

    /**
     * @param Request $request
     */
    private function storeNoAuth(Request $request, $timeOrder)
    {

        $room = $this->getRoomId($request);

        $strTime = "";
        $totalSumm = 0;
        foreach ($timeOrder as $val) {
            $strTime = $strTime . date('Y-m-d: H ', $val) . "-" . date('H', strtotime("+1 hour", $val)) . "<br>";
            $totalSumm += $this->getTimeCost($val, $request->input('type'));
        }

        if(isset($request->paid)){
            $paid = 1;
        } else {
            $paid = 0;
        }

        DB::transaction(function () use ($timeOrder, $room, $strTime, $request, $totalSumm, $paid) {
            $order = Order::create([
                'type' => Input::get('type'),
                'room' => Input::get('room'),
                'time' => Input::get('time'),
                'name' => Input::get('name'),
                'phone' => Input::get('phone'),
                'email' => Input::get('email'),
                'card_number' => Input::get('card_number'),
                'description' => Input::get('description'),
                'agree' => 1,
                'total_summ' => $totalSumm,
                'user_id' => 0,
                'str_text' => $strTime,
                'is_paid' => $paid
            ]);

            $arrayInsert = [];
            foreach ($timeOrder as $val) {
                $costTime = $this->getTimeCost($val, $request->input('type'));
                $arrayInsert[] = [
                    'order_id' => $order->id,
                    'time' => $val,
                    'room_id' => $room,
                    'user_id' => 0,
                    'cost' => $costTime
                ];
            }

            DB::table('times')->insert($arrayInsert);
        });
    }


    public function getTime(Request $request)
    {

        /*
         * booking time
         */

        $room = $this->getRoomId($request);

        $timeBook = $this->getBookingTime($room);

        $timeBookPaid = $this->getBookingTimePaid($room);

        /*
         * first day of week
         */
        $dayIs = date('l', time());


        if ($dayIs != 'Monday') {
            $monday = strtotime("last Monday");
        } else {
            $monday = mktime(0, 0, 0);
        }

        list($yearIs, $monthIsStr) = $this->getMonthYear($monday);

        list($days, $nowDay) = $this->getDays($monday);


        $dayStart = $monday;
        $week = [];


        return $this->timeTable($dayStart, $week, $timeBook, $monthIsStr, $yearIs, $days, $nowDay, $timeBookPaid);
    }


    public function getNextWeek(Request $request)
    {

        /*
         * booking time
         */

        $room = $this->getRoomId($request);

        $timeBook = $this->getBookingTime($room);

        $timeBookPaid = $this->getBookingTimePaid($room);

        $weekIs = Session::get('weekIs');
        $nextWeek = strtotime('+1 week', $weekIs);


        list($yearIs, $monthIsStr) = $this->getMonthYear($nextWeek);

        list($days, $nowDay) = $this->getDays($nextWeek);

        $week = [];

        return $this->timeTable($nextWeek, $week, $timeBook, $monthIsStr, $yearIs, $days, $nowDay, $timeBookPaid);


    }


    public function getPreviousWeek(Request $request)
    {

        /*
         * booking time
         */

        $room = $this->getRoomId($request);

        $timeBook = $this->getBookingTime($room);

        $timeBookPaid = $this->getBookingTimePaid($room);

        $weekIs = Session::get('weekIs');
        $prevWeek = strtotime('-1 week', $weekIs);


        list($yearIs, $monthIsStr) = $this->getMonthYear($prevWeek);

        list($days, $nowDay) = $this->getDays($prevWeek);


        $week = [];

        return $this->timeTable($prevWeek, $week, $timeBook, $monthIsStr, $yearIs, $days, $nowDay, $timeBookPaid);


    }

    /**
     * @param $monday
     * @return array
     */
    private function getMonthYear($monday)
    {
        $yearIs = date('Y', $monday);
        $monthIsNum = date('n', $monday);
        $mons = array(
            1 => trans('messages.Jan'),
            2 => trans('messages.Feb'),
            3 => trans('messages.Mar'),
            4 => trans('messages.Apr'),
            5 => trans('messages.May'),
            6 => trans('messages.Jun'),
            7 => trans('messages.Jul'),
            8 => trans('messages.Aug'),
            9 => trans('messages.Sep'),
            10 => trans('messages.Oct'),
            11 => trans('messages.Nov'),
            12 => trans('messages.Dec')
        );
        $monthIsStr = $mons[$monthIsNum];
        return array($yearIs, $monthIsStr);
    }

    /**
     * retuen dates month and now day number
     * @param $monday
     * @return array
     */
    private function getDays($monday)
    {
        $days = [];
        for ($i = 0; $i <= 6; $i++) {
            $days[] = date('j', strtotime('+' . $i . ' day', $monday));
        }

        /*$nowDay = date('j', time());*/
        $nowDay = date(mktime(0, 0, 0));

        return array($days, $nowDay);
    }

    /**
     * returns a lot of time for a particular week
     * @param $dayStart
     * @param $week
     * @param $timeBook
     * @param $monthIsStr
     * @param $yearIs
     * @param $days
     * @param $nowDay
     * @return array
     */
    private function timeTable($dayStart, $week, $timeBook, $monthIsStr, $yearIs, $days, $nowDay, $timeBookPaid)
    {
        $week['1'] = $dayStart;

        \Session::put('weekIs', $dayStart);

        for ($i = 1; $i <= 6; $i++) {
            $week[$i + 1] = strtotime('+' . $i . ' day', $dayStart);
        }

        for ($i = 1; $i < 24; $i++) {
            $week[] = strtotime('+' . $i . ' hour', $week['1']);
            $week[] = strtotime('+' . $i . ' hour', $week['2']);
            $week[] = strtotime('+' . $i . ' hour', $week['3']);
            $week[] = strtotime('+' . $i . ' hour', $week['4']);
            $week[] = strtotime('+' . $i . ' hour', $week['5']);
            $week[] = strtotime('+' . $i . ' hour', $week['6']);
            $week[] = strtotime('+' . $i . ' hour', $week['7']);
        }


        $disabledTime = [];
        foreach ($week as $val) {
            if ($val < time()) {
                $disabledTime[] = '' . $val . '';
            }
        }

        return [
            'week' => $week,
            'timeBook' => $timeBook,
            'disabledTime' => $disabledTime,
            'month' => $monthIsStr,
            'year' => $yearIs,
            'days' => $days,
            'nowDay' => $nowDay,
            'timeBookPaid' => $timeBookPaid
        ];

    }

    /**
     * return time that already booking
     * @return array
     */
    private function getBookingTime($roomId)
    {
        $times = DB::select('select time, count from times where is_paid = 0 and room_id = ' . $roomId);
        $timeBook = [];
        if (isset($times)) {
            foreach ($times as $key => $val) {
                if($val->count == null){
                    $count = 0;
                } else {
                    $count = $val->count;
                }
                /*$timeBook[] = $val->time;*/
                $timeBook[$val->time] = $count;
            }
            return $timeBook;
        }
        return $timeBook;
    }

    /**
     * return time that already booking and paid
     * @return array
     */
    private function getBookingTimePaid($roomId)
    {
        $times = DB::select('select time from times where is_paid = 1 and room_id = ' . $roomId);
        $timeBookPaid = [];
        if (isset($times)) {
            foreach ($times as $key => $val) {
                $timeBookPaid[] = $val->time;
            }
            return $timeBookPaid;
        }
        return $timeBookPaid;
    }

    /**
     * @param Request $request
     * @return array|int|string
     */
    private function getRoomId(Request $request)
    {
        $room = $request->input('idRoom');

        if (isset($room)) {
            \Session::put('idRoom', $request->input('idRoom'));
        } else {
            $room = \Session::get('idRoom');
        }

        if ($room == "room-1") {
            $room = 1;
            return $room;
        }

        if ($room == "room-2") {
            $room = 2;
            return $room;
        }

        if ($room == "room-3") {
            $room = 3;
            return $room;
        }

        if ($room == "room-4") {
            $room = 4;
            return $room;
        }
    }

    public function getStrTime(Request $request)
    {
        if(isset($request->typeBook2) && ($request->typeBook2 == "no-fix" || $request->typeBook2 == "fix")){
            $data = $request->input('unixTime');
            $dayIs = date('l', $data);
            if($request->typeBook2 == "fix"){
                $cost = 250;
            } else {
                $cost = 300;
            }
            if ($dayIs == 'Saturday' || $dayIs == 'Sunday' || $dayIs == 'Friday') {
                $cost = $cost + 50;
            }
        }

        $data = $request->input('unixTime');
        $typeBook = $request->input('typeBook');


        $dataStr = date("m.d.Y", $data);
        $timeStrStart = date("H:i", $data);
        $timeStrEnd = date("H:i", strtotime("+1 hour", $data));

        $nextWeek = date(strtotime("+1 week", $data));
        $nextWeek2 = date(strtotime("+1 week", $nextWeek));
        $nextWeek3 = date(strtotime("+1 week", $nextWeek2));


        if(isset($request->typeBook2) && ($request->typeBook2 != "no-fix" && $request->typeBook2 != "fix")) {
            $cost = $this->getTimeCost($data, $typeBook);
        }

        return [
            'dataStr' => $dataStr,
            'timeStrStart' => $timeStrStart,
            'timeStrEnd' => $timeStrEnd,
            'cost' => $cost
        ];


    }

    /**
     * @param $data
     * @param $typeBook
     * @return int
     */
    private function getTimeCost($data, $typeBook)
    {
        $dayIs = date('l', $data);

        $cost = 0;
        if ($typeBook == 'child') {
            $cost = 50;
        }
        if ($typeBook == 'adult') {
            $cost = 65;
        }

       /* if ($typeBook == 'rent') {
            $cost = 650;
        }*/

        if ($dayIs == 'Saturday' || $dayIs == 'Sunday' || $dayIs == 'Friday') {
            $cost = $cost + 50;
            return $cost;
        } else {
            return $cost;
        }
    }

    /**
     * @param $timeOrder
     * @param $v
     */
    private function timeUse($timeOrder, $v, $forFoom)
    {
        if ($forFoom == "room-1"){
            $room = 1;
        } elseif($forFoom == "room-2"){
            $room = 2;
        } elseif($forFoom == "room-3"){
            $room = 3;
        } elseif($forFoom == "room-4"){
            $room = 4;
        }

        $times = DB::select('select time from times WHERE room_id = ' .$room);

        $time_use = false;
        foreach ($times as $time) {
            if (in_array($time->time, $timeOrder)) {
                $time_use = true;
                break;
            }
        }
        /*if ($time_use == true) {
            $v->after(function ($v) {
                $v->errors()->add('timeList', 'It is already booked');
            });
        }*/
    }

    /**
     * @param $timeOrder
     * @param $cost
     */
    private function extraCost($timeOrder, $cost)
    {
        foreach ($timeOrder as $time) {
            $dayIs = date('l', $time);
            if ($dayIs == 'Saturday' || $dayIs == 'Sunday' || $dayIs == 'Friday') {
                $cost = $cost + 50;
            }
        }
        return $cost;
    }

}
