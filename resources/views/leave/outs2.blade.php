<?php

$outsday = App\Leave::where([['user_id', '=', $leave->user_id], ['year', '=', $leave->year], ['status', '=', 3]])->latest()->take(1)->pluck('outsdays');

echo $outsday[0];

?>