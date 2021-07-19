<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover,
        a:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center">User Details</h2>

    <div class="card">
        <div id="details"></div>
        <a href="index.html"><button>back</button></a>
    </div>
</body>
<script>

    $(document).ready(function () {
        const urlstring = window.location.search;
        $.ajax({
            type: "GET",
            url: "http://localhost/webTechTest/api/getSingleUser.php" + urlstring,
            dataType: "json",
            success: function (data, status, xhr) {
                var userInfo = "";
                userInfo += "<h1>" + data.name + "</h1>";
                userInfo += "<p>Username : " + data.username + "</p>";
                userInfo += "<p>Email : " + data.email + "</p>";
                userInfo += "<p>Phone No : " + data.phoneNo + "</p>";
                userInfo += "<p>Role : " + data.role + "</p>";

                // userInfo += "<p>Date : " + data.patient_admission + "</p>";

                document.querySelector("#details").innerHTML = userInfo;
            },

            error: function () {
                alert(status);
            },
        });
    });
</script>

</html>