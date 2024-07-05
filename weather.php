<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <style>
        body{
            background-color:#add8e6;
            font-family:cursive;
        }
        .container{
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }
        h1{
            font-size:50px;
        }
        .ipcontainer{
            display:flex;
            margin:40px 0px;
        }
        input[type="text"]{
            height:40px;
            width:500px;
            font-size:large;
            border-radius:15px;
        }
        input[type="submit"]{
            font-size:large;
            height: 40px;
            border-radius:15px;
        }
        .opcontainer{
            display:flex;
        }
        .box{
            border:5px solid;
            border-radius:15px;
            width:350px;
            height:200px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            margin:5px;
        }
        h2{
            font-size:35px;
        }
        h3{
            font-size:30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if(isset($_POST['name'])){
                    $city_name = $_POST['name'];
                    $url = "https://api.openweathermap.org/data/2.5/weather?q= $city_name&appid=345381fa30321f3a7cde513ff78ef1aa";
                    $ch = curl_init();
                    curl_setopt($ch,CURLOPT_URL,$url);
                    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                    $result = curl_exec($ch);
                    curl_close($ch);

                    $result = json_decode($result,true);//converted to array
                    // print_r($result);
                    // die();
                }
            }
        ?>
        <h1>Weather App</h1>
        <div class="ipcontainer">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <input type="text" name="name" id="name" placeholder="Enter the name of the city">
                <input type="submit" value="Search">
            </form>

        </div>
        <div class="opcontainer">
            <div class="box">
                <h2>City name</h2>
                <h3><?php echo isset($result['name']) ? $result['name'] : '';?></h3>
            </div>
            <div class="box">
                <h2>Temperature</h2>
                <h3><?php echo isset($result['main']['temp']) ? round($result['main']['temp']-273.15)."°C" : ''?></h3>
            </div>
            <div class="box">
                <h2>Humidity</h2>
                <h3><?php echo isset($result['main']['humidity']) ? $result['main']['humidity']: ''?></h3>
            </div>
        </div>
    </div>
</body>
</html>