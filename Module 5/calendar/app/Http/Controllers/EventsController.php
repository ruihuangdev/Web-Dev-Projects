<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;

class EventsController extends Controller
{
  public function index(){
    $events = App\Event::all();
    return view('events.index', compact('events'));
  }
}
