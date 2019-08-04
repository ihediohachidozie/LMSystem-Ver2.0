<div class="container">
    <p>Dear {{ $userdata['firstname'] }},</p>
    <p>Kindly be informed that your leave application request is {{ $leave['status'] }}.</p>
    <p>
        @if ($comment)
            {{
                'Reason: '. $comment
            }}
            
        @endif
    </p>

    <p>Regards...</p>  
    
</div