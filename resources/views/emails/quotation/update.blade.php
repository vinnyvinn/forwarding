@component('mail::message')

{{$data['message']}}

@component('mail::button', ['url' => url($data['url'])])
    View Quotation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
