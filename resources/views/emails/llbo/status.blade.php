<x-mail::message>
# LLBO License Verification Update

Hi {{ $verification->user->name }},

@if($status === 'verified')
Your LLBO license has been verified. You can now access your dashboard and place orders.
@else
Your LLBO license verification was rejected. Please review the notes below and resubmit your license.
@endif

@if($verification->verification_notes)
> Admin notes: "{{ $verification->verification_notes }}"
@endif

License Number: {{ $verification->license_number }}  
Type: {{ $verification->license_type }}  
Expiry: {{ $verification->expiry_date->format('M d, Y') }}

<x-mail::button :url="url('/user/llbo-verification')">
View LLBO Status
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
