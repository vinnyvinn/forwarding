@component('mail::message')
# Purchase Order Number {{ ucfirst($data['po_number']) }}

{{ ucfirst($data['message']) }}

@component('mail::button', ['url' => url('view-po/'.$data['po_id'])])
View Purchase Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
