<form>
    <div style=" width:500px;
        margin: 0 auto;
        padding: 15px;
        text-align:center">
        <h1 style="background:rgb(24,119,242);border-radius:5px; color:white;height: 50px;padding-top:5px">Shop Maverick-Dresses</h1>
        <hr style="font-weight:bold;border: 1px solid black"/>
        <h2 style="color:black">Hi <strong style="color:rgb(24,119,242)">{{$name_customer}} !!!</strong></h2>
        Confirm your order has been placed successfully!.
        <p style="color:black">
            This is your Code_Order <p style="text-align:center"><hr style="width:30%;border: 1px solid black"/><input style="text-align:center;background:rgb(24,119,242);color:black;font-weight:bold;font-size:23px;padding:10px 0;border:none;outline:none;border-radius:5px" type="text" value="{{$code_order}}" disabled></p>
        </p>
        <p style="color:black">You can use this code to check your order at website</p>
        <p><button style="border:none;outline:none;background:rgb(24,119,242);width:100%;height:50px;border-radius:5px"><a style="text-decoration:none;font-weight:bold; color:white;" href="http://localhost:8000/">Chuyển trang đến shop Maverick Dress</a></button></p>
        <p style="color:black;font-weight:bold">Total order value: {{number_format(($total_price_result),0,"",".")}}đ</p> 
        <hr/>
        <p style="color:black;font-weight:bold;">Thank you for purchasing from our shop. Have a nice day!!!
        </p>
    </div>
</form>