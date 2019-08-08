<?php
$name = App\User::where('id', $comment->approval_id)->first();


echo $name->firstname;

?>