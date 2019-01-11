{{--  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>
        {{ $writer->name }}
         Welcome
    </h1>
</body>
</html>  --}}
@component('mail::message')


Thank you registering {{ $writer->name }}. Please Click the link below to complete registeration.

@component('mail::button', ['url' => ''])
complete Registration
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

