$(document).ready(function() {
    $("#addmore").click(function() {
        $("#addimg").append(`
            <label>Hình Ảnh</label>
            <input type="file" class="form-control" name="src[]">
        `);
    })

    $("#addsz").click(function() {
        $("#addsize").append(`
            <label>Size</label>
            <input type="text" class="form-control" name="size[]" placeholder="Please choose size">
        `);
    })




    $("#add").click(function() {
        $("#addcolor").append(
            `<div class="form-group">
            <label>Màu sắc : </label>
            <input type="color" class="form-control" name="color">

            <label>Size : </label> 
            <select name="size" class="form-control" id="form-group" style="text-align:center">
                <option value="1" >M</option>
                <option value="2">X</option>
                <option value="3">L</option>
            </select>
        </div>`
        )
    })
});

function confirmDelete() {
    if (window.confirm("Do you really want to delete ???")) {
        return true;
    }
    return false;
}

function confirmPayment() {
    if (window.confirm("Are you sure about that???")) {
        return true;
    }
    return false;
}

$(document).ready(function(){
    $('#1').click(function(){
        $('#paypal-button').show();
        $('#confim').hide();
      
    });
    $('#2').click(function(){
        $('#confim').show();
        $('#paypal-button').hide();
    });
    $('#oder').click(function(){
        $('#form-oder').show();
    })
});