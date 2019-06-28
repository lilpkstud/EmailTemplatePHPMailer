<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pigeon Post</title>
    <!--AJAX-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>

</head>
<body>
    <p>This page will show all user's emails BUT need to create a firebase DB</p>
    <form action="/mail.php" method="post" name="allUsers">
        <table id="allUsers">
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Send Newsletter</th>
            </thead>
            <tbody>

            </tbody>
        </table>
        <input type="submit" name="Send to User(s)">
    </form>

    <!-- Value -->
    <pre id="object"></pre>

    <!-- Child -->






    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.2.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-functions.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.3/firebase-database.js"></script>
    <script src="js/app.js"></script>


</body>
</html>