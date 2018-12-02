<?php
  // This section displays the calendar
?>
<section class="section">
  <div class="container">
    <h5 class="center">Your calendar</h5>
    <div class="date-container">
      <a id="prevMonth"><i class="material-icons">arrow_back</i></a>
      <div class="currentMonth">
        <h6 id="month">month</h6>
        <h6>&nbsp;</h6>
        <h6 id="year">year</h6>
      </div>
      <a id="nextMonth"><i class="material-icons">arrow_forward</i></a>
    </div>
  </div>
  <div class="calendar-head">
    <div class="weekday">Sun</div>
    <div class="weekday">Mon</div>
    <div class="weekday">Tue</div>
    <div class="weekday">Wed</div>
    <div class="weekday">Thu</div>
    <div class="weekday">Fri</div>
    <div class="weekday">Sat</div>
  </div>
  <div class="calendar-display" id="calendar">
    <div class="calendar-column">
      <div class="calendar-row">1</div>
      <div class="calendar-row">2</div>
      <div class="calendar-row">3</div>
      <div class="calendar-row">4</div>
      <div class="calendar-row">5</div>
      <div class="calendar-row last">6</div>
    </div>
    <div class="calendar-column">
      <div class="calendar-row">1</div>
      <div class="calendar-row">2</div>
      <div class="calendar-row">3</div>
      <div class="calendar-row">4</div>
      <div class="calendar-row">5</div>
      <div class="calendar-row last">6</div>
    </div>
    <div class="calendar-column">
      <div class="calendar-row">1</div>
      <div class="calendar-row">2</div>
      <div class="calendar-row">3</div>
      <div class="calendar-row">4</div>
      <div class="calendar-row">5</div>
      <div class="calendar-row last">6</div>
    </div>
    <div class="calendar-column">
      <div class="calendar-row">1</div>
      <div class="calendar-row">2</div>
      <div class="calendar-row">3</div>
      <div class="calendar-row">4</div>
      <div class="calendar-row">5</div>
      <div class="calendar-row last">6</div>
    </div>
    <div class="calendar-column">
      <div class="calendar-row">1</div>
      <div class="calendar-row">2</div>
      <div class="calendar-row">3</div>
      <div class="calendar-row">4</div>
      <div class="calendar-row">5</div>
      <div class="calendar-row last">6</div>
    </div>
    <div class="calendar-column">
      <div class="calendar-row">1</div>
      <div class="calendar-row">2</div>
      <div class="calendar-row">3</div>
      <div class="calendar-row">4</div>
      <div class="calendar-row">5</div>
      <div class="calendar-row last">6</div>
    </div>
    <div class="calendar-column">
      <div class="calendar-row">1</div>
      <div class="calendar-row">2</div>
      <div class="calendar-row">3</div>
      <div class="calendar-row">4</div>
      <div class="calendar-row">5</div>
      <div class="calendar-row last">6</div>
    </div>
  </div>
</section>

<div class="newEvent pinned center">
  <form>
    <i id="closeNewEvent" class="material-icons">close</i>
    <label for="event-date">Date</label>
    <input type="date" name="event-date" id="event-date">
    <label for="event-start-time">Start time</label>
    <input type="time" name="event-start-time" id="event-start-time">
    <label for="event-end-time">End time</label>
    <input type="time" name="event-end-time" id="event-end-time">
    <label for="event-name">Event</label>
    <input type="text" name="event-name" id="event-name">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
    <button type="submit" class="btn waves-effect waves-light blue" name="submit">Add Event</button>
  </form>
</div>
