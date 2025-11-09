<!DOCTYPE html>
<html>
<body>
    <h2>Hello {{ $user->name }},</h2>
    <p>We’re sorry to inform you that your voter registration has been <strong>rejected</strong>.</p>
    <p>If you believe this is a mistake, please contact the election administrator.</p>
    <p>Thank you,<br>{{ config('app.name') }}</p>
</body>
</html>
