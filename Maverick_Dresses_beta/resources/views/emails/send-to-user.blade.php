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
        <h3 style="color:black">Nhận mã xác minh</h3>
        <h4 style="color:black">Hi <strong style="color:rgb(24,119,242)">{{$name}}</strong></h4>
        <p style="color:black">Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu về tài khoản Shop MAVERRICK_DRESESS của bạn.</p>
            <p>Nhập mã để đặt lại mật khẩu.Vui lòng đừng gửi mã xác nhận này cho người lạ.</p>
        <!-- <p>Your verification code is: </p>  -->
        <div class="confirm form-control">
            <label for="">Mã xác nhận của bạn là</label>
            <hr style="width:30%;;border: 1px solid black"/>
            <p><input style="color:white;background-color:rgb(24,119,242); text-align:center;height:30px;border-radius:5px;font-weight: bold;font-size:18px;outline:none;border:none" type="text" value="{{$randomNumber}}" disabled="disabled"></p>
        </div>

        <p style="color:black">Ngoài ra, bạn có thể thay đổi trực tiếp mật khẩu của mình.</p>
        <p><button type="submit" style="background-color:rgb(24,119,242);border-radius:5px;width:100%;height:50px;outline:none;border:none"><a style="text-decoration: none;font-weight: bold;color:white" href="{{route('fillNewPasswordView',['id'=>$id])}}">Đổi mật khẩu</a></button></p>

        <p style="color:black">THANKS!!!!</p>
        <p style="color:black">Chi tiết liên hệ : <a href="mailto:phamphucloi460@gmail.com">phamphucloi460@gmail.com</a></p>
    </div>
</form>