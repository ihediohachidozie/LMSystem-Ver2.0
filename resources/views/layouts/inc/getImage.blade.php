<div class="dropdown-list-image mr-3">
    <img class="rounded-circle" src="{{ asset('storage/')}}<?php  
        $name = App\User::where('id', $comment->approval_id)->first();
         echo "/".$name->image;
         ?>" alt="">
    <div class="status-indicator bg-success"></div>
</div> 