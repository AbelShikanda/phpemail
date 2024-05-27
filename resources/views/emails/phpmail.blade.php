@component('mail::message')
# {{ $job->name }}
## Greetings You

We have just posted a new job.

@component('mail::button', ['url' => url('/jobs/detail/' . $job->id)])
View the new listing
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
