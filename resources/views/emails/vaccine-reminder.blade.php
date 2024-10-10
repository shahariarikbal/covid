<!DOCTYPE html>
<html>
<head>
    <title>Vaccination Reminder</title>
</head>
<body>
    <h1>Reminder for your Vaccination Appointment</h1>
    <p>Dear {{ $vaccination->full_name }},</p>
    <p>This is a reminder that your vaccination appointment is scheduled for tomorrow, {{ \Carbon\Carbon::parse($vaccination->vaccine_date)->format('F j, Y') }}.</p>
    <p>Please make sure to be at the vaccination center on time.</p>
    <p>Thank you!</p>
</body>
</html>
