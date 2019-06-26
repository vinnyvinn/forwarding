@component('mail::message')
# Accounts

{{ ucfirst($data['message']) }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
