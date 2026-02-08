<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    
     public function show()
    {

        $event = Event::all()->map(fn($event) => [
               'id'    => $event->id,
               'title' => $event->title,
               'start' => $event->start->toIso8601String(),
               'end'   => $event->end->toIso8601String(),
               'backgroundColor' => $event->background_color,
               'borderColor' => $event->background_color
          ]);

          return $event;

    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
    }



}
