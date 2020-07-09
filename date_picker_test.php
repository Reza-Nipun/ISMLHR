<!DOCTYPE html>
<html>
<head>
    <title>jQuery UI Datepicker - Change Date Format Example</title>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
</head>

<body>
<p>Set focus on the box to select a date. (shows default format)</p>
<div>
    Date: <input type="text" id="tbDate" />
</div>
</body>

<script>
    $(document).ready(function () {
        $('input[id$=tbDate]').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>
</html>