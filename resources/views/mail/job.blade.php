@component('mail::message')
# {{ $user->name }} post a job for the first time

Title: <br>
## {{ $data->title }} <br>
Description: <br>
## {{ $data->description }}

@component('mail::button', ['url' => route('job.approve', ['data' => $data, 'user' => $user]) ])
Approve
@endcomponent

@component('mail::button', ['url' => route('job.spam', ['data' => $data, 'user' => $user]) ])
Spam
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
