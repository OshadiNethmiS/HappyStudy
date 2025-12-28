<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #9fd0f1ff;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }
        h2{
            font-size: 90px;
            font-family:Agency FB;
            font-weight: bold;
            color: #1a0957ff;
        }
        h3{
            font-size: 19px;
            margin-bottom: 10px;
            color: #111111;
            
        }
        h4{
            font-size: 27px;
            margin-bottom: 10px;
            color: #1a0957ff;
            margin:20px;
        }
        p{
            font-size: 40px;
            margin-bottom: 5px;
            color: #1a0957ff;
            font-weight: bold;
        }
        a {
            padding: 100px 80px;
            text-decoration: none;
            color: #1a0957ff;
            font-size:24px; 
            }
        .container {
            width: 850px;
            height: 600px;
            background: white;
            display: flex;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow:hidden;
        }

        .left {
            flex: 1;
            background: linear-gradient(135deg, #ffffff, #9fd0f1ff); 
            color: white;
            text-align: center;
            padding: 60px;
        }

        .left h2 {
            margin-bottom: 15px;
        }

        .left button {
            background: #16ac36ff;
            border: none;
            padding: 12px 35px;
            border-radius: 25px;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        .right {
            flex: 1.2;
            padding: 50px;
        }

        .right form input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .right button {
            background: #1a0957ff;;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 25px;
            color: white;
            font-weight: bold;
            cursor:pointer;
        }

    </style>
</head>