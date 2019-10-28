<div class="container">
    <p>Dear {{ $userdata1['firstname'] }},</p>
    <p>Kindly be informed that your leave application request is {{ $leave['status'] }}.</p>
    <p>
        @if ($comment)
            {{
                'Reason: '. $comment
            }}
            
        @endif
    </p>
    <p><a href="https://www.ecmterminals.com/LMSystem"></a></p>
    <p>Regards...</p>  
    
</div>