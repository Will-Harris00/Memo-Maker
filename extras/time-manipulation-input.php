<!DOCTYPE html>
<html lang="en">
<body>

<h1>Date and Time Controller</h1>

<form action="time-manipulation-output.php" method="post">
    <label for="datetime">Datetime (date and time):</label>
    <input type="datetime-local" id="datetime" name="datetime">
    <input type="date" id="date" name="date">
    <input type="time" id="time" name="time">
    <input type="submit">
</form>

<p><strong>Note:</strong> type="datetime-local" is not supported in Firefox, Safari or Internet Explorer 12 (or earlier).</p>

</body>
</html>
