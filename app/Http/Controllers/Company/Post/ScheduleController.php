<?php

namespace App\Http\Controllers\Company\Post;

use App\Http\Controllers\apiController;
use App\Http\Resources\InterviewResource;
use App\Http\Resources\ScheduleResource;
use App\Models\Interview;
use App\Models\Post;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ScheduleController extends apiController
{
    public function index($post_id){
        $schedule = Post::find($post_id)->schedules()->get();
        if(count($schedule) > 0)
            return $this->apiResponse(ScheduleResource::collection($schedule->load('interviews')), self::STATUS_OK, 'Schedule Data returned successfully');
        return $this->apiResponse([] , self::STATUS_NO_CONTENT , 'There are no data');

    }

    // when i click on schedule tap i want to see interviews
    public function show($schedule_id){
    $interviews = Schedule::find($schedule_id)->interviews()->get();
        if(count($interviews) > 0)
            return $this->apiResponse(InterviewResource::collection($interviews->load('user')), self::STATUS_OK , 'interviews response successfully');
        return $this->apiResponse([] , self::STATUS_NO_CONTENT , 'There are no data');

    }
    public function store(Request $request){
        $validate = $this->apiValidation($request , [
            'post_id' => 'required|exists:posts,id',
            'day' => 'required|date',
            'open_time' => 'required',
            'close_time' => 'required',
            'interview_period' => 'required|numeric|max:90|min:30',
            'rest_period' => 'required|numeric|max:30|min:5'
        ]);

        if($validate instanceof Response) return $validate;
        $schedule = Schedule::create($request->all());
        $begin_time = \Carbon\Carbon::parse($schedule->open_time);
        $stop_time =  \Carbon\Carbon::parse($schedule->close_time);
        while (1) {
            $begin_time->addMinutes($schedule->interview_period);
            if($begin_time >= $stop_time)
                break;
            $schedule->interviews()->create([
                'time_from' => $begin_time->subMinutes($schedule->interview_period)->format('h:i:s'),
                'time_to' => $begin_time->addMinutes($schedule->interview_period)->format('h:i:s'),

            ]);
            $begin_time->addMinutes($schedule->rest_period);
        }

        return $this->apiResponse(new ScheduleResource($schedule) , self::STATUS_CREATED , 'Schedule created successfully');

    }



//    public function interviews($schedule_id){
//
//        $interviews = Schedule::find($schedule_id)->interviews()->get();
//        return InterviewResource::collection($interviews->load('user'));
//        ret
//
//    }
}
