<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Online Course Registration</title>
  <style>
    body {    /*background*/
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(135deg, #ffffff, #9fd0f1ff); 
      color: white;
      text-align: center;
    }
    header {    
      padding: 20px;
      font-size: 90px;
      font-family:Agency FB;
      font-weight: bold;
      color: #1a0957ff;
      text-align: left;
    }
    h1{
      padding: 10px;
      font-size:45px;
      font-family:'Segoe UI', sans-serif;
      font-weight: bold;
      color: #1a0957ff;
      margin :20px;
    
    }
    h2 {
      font-size: 27px;
      margin-bottom: 10px;
      color: #1a0957ff;
      margin:20px;
    }
    h3{
      padding: 10px;
      font-size:25px;
      font-family:'Segoe UI', sans-serif;
      font-weight: bold;
      color: #f5f4f7ff;
      text-decoration: none;
    }
    
    .nav {
      list-style-type: none;
      margin: 0;
      padding: 20px;
      display: flex;
      justify-content: space-between; /* left & right separate */
      align-items: center;            /* vertically center */
      background-color: #b6daf1ff;
    }

   .a a {
      text-decoration: none;
      color: #095716ff;
      font-style:bold;
 
    }
    a:hover {
      background-color: lightgreen;
    }
   
    .main {
      padding: 10px 20px;
    }

    .main h2 {
      font-size: 27px;
      margin-bottom: 10px;
      color: #2f2f5f;
      
    }
    .cards {    /* justify Cads*/
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;                                           
      margin-top: 40px;
      background:; /*#4d2bc9ff;*/
    }
    
    .card {   /* backgorund size*/
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 40px;
      background: rgba(255, 255, 255, 0.1);
      width: 0px;
      padding: 30px;
      border-radius: 12px;
      color: white;
      transition: 0.3s;
    }      
    .card:hover {
      box-shadow: 4px 16px 30px #160d4dff;
    }

    footer {    /*footer*/
      margin-top: 60px;
      font-size: 15px;
      padding: 30px;
      color:white;
      background: #1a0957ff;
    }
    .about-section {
      justify-content: space-between;
      gap: 20px;
      color: #1a0957ff; 
      border: 2px solid #1a0957ff; 
      padding: 50px;
      border-radius: 50px 20px;

    }

    .about-box {
      flex: 5;
      padding: 10px;
      border-radius: 6px;
      font-family: sans-serif;
      background: linear-gradient(to bottom, #f4f4f4, #fff);
      border: 1px solid;
      
    }

    .button {
      background-color: #05f011ff;
      color: white;
      padding: 15px 27px;      /* size reduce */
      text-align: center;
      text-decoration: none;
      font-size: 20px;
      border: none;
      border-radius: 20px;
      font-weight: bold;
    }
     /* body { font-family: Arial; background: #eef6fcff; margin:0; }*/
        .container { display: flex; padding: 20px; gap: 20px; }
        .left-panel { width: 50%; }
        .right-panel { width: 50%; padding: 20px; background: #fff; border-left:2px solid #ccc; display: none; flex-direction: column; gap:10px;}
        .right-panel.active { display: flex; }
        .course-cards { display: flex; flex-wrap: wrap; gap: 20px; }
        .card {
            background: #4d2bc9ff; color: white;
            width: 200px; padding: 20px;
            border-radius: 15px; cursor: pointer;
            transition: transform 0.2s;
        }
        .card:hover { transform: scale(1.05); }
        input, textarea { width: 100%; padding:10px; margin-top:10px; font-size:16px; }
        button { padding:12px; background:#11004d; color:white; border:none; border-radius:8px; font-size:16px; cursor:pointer; margin-top:10px;}
        h1, h2 { text-align:center; }
        .add-course { background:#f3f3f3; padding:15px; border-radius:10px; margin-bottom:20px;}
        
    
  </style>

</head>