<?php
header('Content-Type: application/json');

$con = mysqli_connect('localhost', 'root', '', 'coffee_latera');

$q = $con->query("SELECT * FROM `reservation`");

$events = [];
while ($row = mysqli_fetch_object($q)) :
	$event = new stdClass();
	$event->members_ = $row->total_members;
	$event->tables_ = $row->total_tables;
	$event->table_location = $row->table_location;
	$event->start = $row->start_time;
	$event->end = $row->end_time;
	$events[] = $event;
endwhile;

try {
	echo json_encode($events, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
	exit($e->getTraceAsString());
}
