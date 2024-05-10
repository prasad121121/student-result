<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
        }
        .container{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .price {
            color: grey;
            font-size: 22px;
        }
        .card button {
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        .card button:hover {
            opacity: 0.7;
        }
    </style>
     background-image: url('KolhapurCampus.webp');



    <div class="container">
        <div class="card">
            <h1>MCA</h1>
            <input type="hidden" id="MCA" value='0' name ="MCA">
            <p><button onclick="redirectTo('teachar.php')">Click here</button></p>
        </div>
        <div class="card">    
            <h1>MBA</h1>
            <input type="hidden" id="MBA" value='1' name ="MBA">
            <p><button onclick="redirectTo('teacherMBA.php')">Click here</button></p>
        </div>
    </div>
    

    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>
