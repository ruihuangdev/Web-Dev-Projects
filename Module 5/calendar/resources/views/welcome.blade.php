<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>uCal</title>
</head>
<body>
	<ul>
		@foreach($events as $event)
			<a href="/tasks/{{$event->id}}">
				<li>{{$event->event_name}}</li>
			</a>
		@endforeach
	</ul>
</body>
</html>