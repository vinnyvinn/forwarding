@component('mail::message')

    Kindly review this quotation accordingly.
    <br>

@component('mail::button', ['url' => url($data['url'])])
    View Quotation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
