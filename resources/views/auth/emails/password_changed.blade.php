<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Hi {{ $user->name }},
    <br>

    We wanted to let you know that your {{ getenv('APP_NAME') }} password has changed successfully.
</div>

</body>
</html>
