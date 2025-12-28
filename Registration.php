 <!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #b9f1f1ff;
            padding: 30px;
        }
        .container {
            width: 700px;
            margin: auto;
            background:  linear-gradient(135deg, #ffffff, #9fd0f1ff); 
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        .nav {
            list-style-type: none;
            padding: 0;
            display: flex;
            border: 0px solid;
            background-color: #b6daf1ff;
             margin: 0;
        }
        header {    
            padding: 20px;
            font-size: 90px;
            font-family:Agency FB;
            font-weight: bold;
            color: #1a0957ff;
            text-align: left;
            }
        h2 {
            font-size: 27px;
            margin-bottom: 10px;
            color: #1a0957ff;
            margin:20px;
            }
        h4 {
             text-align: center; 
             margin-bottom: 20px; 
             color: #1a0957ff;
        }
        h3 {
            font-size: 20px;
           /* margin: 20px;*/
            color: #1a0957ff;
        }

        .row {
            /*display: flex;*/
            gap: 10px;
            margin: 30px 40px ;
        }
        .row-2 {
            display: flex;
            width: 80%;
        }
        .row input, select {
            width: 80%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        .label-title {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            font-size: 18px;
        }
        .input-group { 
            margin-bottom: 15px;
        }

        .gender-box {
            margin-left: 35px;
        }

        .btn-box {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-btn { background: #007bff; color: white; }
        .cancel-btn { background: #ff4d4d; color: white; }
    </style>
</head>

<body>

<div class="container">
    <header>
    <img src="images/img_01.WEBP" alt="Site Logo" width=150> 
    HappYstudY
    <h2>     ..Your Easy Path to Learning.. </h2>
    
  </header>
  <div class="nav">
        <h1>Registration Form</h1>
</div>
    <form action="register_process.php" method="POST">

        <div class="row">
            <h3>  Name </h3> 
        <div class="row-2">
            <input type="text" name="fname" placeholder="First Name" required>
            <input type="text" name="lname" placeholder="Last Name" required>
        </div> 
        </div> 

        <div class="row">
            <h3> Address </h3>
            <input type="text" name="address" placeholder="Address" required>
        </div>

        <div class="row">
            <h3> Email </h3>
            <input type="email" name="email" placeholder="Email Address" required>
        </div>

        <div class="row">
            <h3> Phone Number </h3>
            <input type="text" name="phone" placeholder="Phone Number" required>
        </div>

        <div class="row">
            <h3>Date of Birth</h3>
            <input type="date" name="dob" required>
        </div>

        <div class="gender-box">
            <h3>Gender:</h3><br>
            <input type="radio" name="gender" value="Male" required> Male
            <input type="radio" name="gender" value="Female" required> Female
        </div>

        <div class="row">
            <h3>Course</h3>
            <select name="course" required>
                <option disabled selected>-- Select Course --</option>
                <option>Web Designing</option>
                <option>Software Engineering</option>
                <option>Graphic Designing</option>
                <option>IT Diploma</option>
            </select>
        </div>

        <div class="btn-box">
            <button type="submit" class="submit-btn">Submit</button>
            <button type="reset" class="cancel-btn">Cancel</button>
        </div>

    </form>
</div>

</body>
</html>
