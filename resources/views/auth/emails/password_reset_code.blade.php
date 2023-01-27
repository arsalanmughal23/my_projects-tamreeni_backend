<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
</head>

<body>
    <div>

        <b>Hi {{ $user->name }}</b>,
        <br />
        We got a request to reset your {{ getenv('APP_NAME') }} password.
        <br />
        Your verification code : <strong>{{ $verification_code }}</strong>
        <br />
        If you didn't request, please ignore this email.
    </div>
</body>
</html>
