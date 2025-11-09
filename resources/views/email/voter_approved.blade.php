<!DOCTYPE html>
<html>
<body>
    <h2>Hello {{ $user->name }},</h2>
    <p>Good news! Your voter registration has been <strong>approved</strong>.</p>
    <p>You can now log in and participate in upcoming elections.</p>
    <p>Thank you,<br>{{ config('app.name') }}</p>
</body>
</html>
