<?php

$outsday = App\Leave::where(['user_id' => $user->id, 'year' => $key, 'status' => '2'])->orderBy('id', 'desc')->pluck('outsdays')->first();

echo $outsday;

?>