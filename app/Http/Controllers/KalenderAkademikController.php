<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use Illuminate\Http\Request;

class KalenderAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = array();
        $kalender = KalenderAkademik::all();
        foreach ($kalender as $k) {
            $color = null;
            if ($k->status == 'masuk') {
                $color = '#924ACE';
            }
            if ($k->title == 'libur') {
                $color = '#68B01A';
            }

            $events[] = [
                'id'   => $k->id,
                'title' => $k->title,
                'start' => $k->start_date,
                'end' => $k->end_date,
                'status' => $k->status,
                'color' => $color
            ];
        }
        return view('pages.akademik.data-kalender-akademik.kalender', ['events' => $events])->with('title', 'Kalender Akademik');
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
        $request->validate([
            'title' => 'required|string'
        ]);

        $booking = KalenderAkademik::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'libur'
        ]);

        $color = null;

        if ($booking->title == 'Test') {
            $color = '#924ACE';
        }

        return response()->json([
            'id' => $booking->id,
            'start' => $booking->start_date,
            'end' => $booking->end_date,
            'title' => $booking->title,
            'color' => $color ? $color : '',

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KalenderAkademik  $kalenderAkademik
     * @return \Illuminate\Http\Response
     */
    public function show(KalenderAkademik $kalenderAkademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KalenderAkademik  $kalenderAkademik
     * @return \Illuminate\Http\Response
     */
    public function edit(KalenderAkademik $kalenderAkademik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KalenderAkademik  $kalenderAkademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking = KalenderAkademik::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json('Event updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KalenderAkademik  $kalenderAkademik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = KalenderAkademik::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
    }
}
