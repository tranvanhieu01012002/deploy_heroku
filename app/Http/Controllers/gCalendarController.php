<?php

namespace App\Http\Controllers;

use App\Components\GoogleClient;
use Illuminate\Http\Request;
use Google_Service_Calendar;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class gCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('calendar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }
    //

    protected $client;
    //

    public function __construct(GoogleClient $client)
    {
        $this->client = $client->getClient();
    }

    public function createEvent(Request $request)
    {
        $calendarService = new Google_Service_Calendar($this->client);

        $event = new \Google_Service_Calendar_Event([
            'summary' => "add form",
            'description' => $request->description,
            'start' => [
                'dateTime' => $this->convertTime($request->start)
            ],
            'end' => [
                'dateTime' => $this->convertTime($request->end)
            ],
            // 'attendees' => $this->getAttendees($request->attendees)
            'attendees' =>
            array(
                array('email' => 'hieu.tran23@student.passerellesnumeriques.org')
            ),
            // "conferenceData".conferenceSolution.key.type
            "conferenceData" => [
                'createRequest' => [
                    'requestID' => 'simple123',
                    ' conferenceSolutionKey' => ['type' => 'hangoutsMeet']
                ]
            ]

        ]);
        dd($calendarService->events->insert('primary', $event, ['conferenceDataVersion' => 1]));
    }
    private function convertTime($time, $min = 0)
    {
        return Carbon::parse($time, 'Asia/Bangkok')->addMinutes($min)->toIso8601String();
    }
    private function getAttendees($emails)
    {
        $attendees = [];

        foreach ($emails as $email) {
            if ($email) {
                $attendees[] = [
                    'email' => $email
                ];
            }
        }

        return $attendees;
    }
}
