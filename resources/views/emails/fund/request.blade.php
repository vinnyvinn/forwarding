@component('mail::message')

    {!! $data['message']  !!}

Kind Regards,

{{ ucwords($data['user']) }} | Forwarding Department <br>
6th Floor, Cannon Towers II, Moi Avenue <br>
P. O. Box 1922 - 80100, Mombasa, Kenya <br>
Phone: +254 41 2229784/6/2224822 <br>
<p style="font-weight: 600">Notice to Kenyan Importers</p>
<p style="font-size: smaller; font-weight: 300">
All containers to Kenya must be weighed at origin and weight certificate issued, for more information on the SOLAS VI Regulation 2 amendments coming into force 1st July 2016 and its impact on shippers, please contact us at any time for clarification.
All imports to Kenya must be inspected at origin and Certificate of Conformity issued
</p>
<a href="http://www.esl-eastafrica.com">http://www.esl-eastafrica.com</a>
<img src="{{ asset('/images/logo.png') }}" alt="">
<h4>Powering our Customers to be Leaders in their Markets</h4>
@endcomponent
