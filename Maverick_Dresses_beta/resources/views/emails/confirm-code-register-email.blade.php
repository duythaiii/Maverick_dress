<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body{
        font-size: 23px;
    }

    .wrapper{
        background-color:red;
        width: 40%;
        height: 4%;
        padding-top:5px;
        overflow: hidden;
        border-radius: 3px;
        text-align: center;
        margin:auto
    }
    input{
        text-align: center;
        width: 20%;
        height: 2%;
        overflow: hidden;
        border-radius: 5px 0 5px 0;
        box-shadow: 3px -3px 2px 2px transparent;
        background:#8bf5f5;
        font-weight: bold;
        font-size: 18px;
        margin-left: 10px;
        margin-top:5px;
        transition: 0.5s;
    }
    input:focus{
        border-radius: 0px 5px 0 5px ;
    }
</style>

<form action="" style="color:black">
    <div style=" width:500px;
    margin: 0 auto;
    padding: 15px;
    text-align:center">
        <div class="wrapper">
            <h1 style="background:rgb(24,119,242);border-radius:5px; color:white;height: 50px;padding-top:5px">Maverick-Dresses</h1>
        </div>
        <hr style="border: 1px solid black"/>
        <h3 style="color:black">Get verification code</h3>
        <h4 style="color:black">Hi <strong style="color:rgb(24,119,242)">{{$name}}</strong></h4>
        <p style="color:black">We have received your request to register for your Shop MAVERRICK_DRESESS account.</p>
            <p>Enter the code to create an account.</p>
        <!-- <p>Your verification code is: </p>  -->
        <div class="confirm form-control">
            <label for="">Your verification code is</label>
            <hr style="width:30%;;border: 1px solid black"/>
            <p><input style="color:white;background-color:rgb(24,119,242); text-align:center;height:30px;border-radius:5px;font-weight: bold;font-size:18px;outline:none;border:none" type="text" value="{{$randomNumber}}" disabled="disabled"></p>
        </div>

        <p style="color:black">THANKS!!!!</p>
    </div>
</form>