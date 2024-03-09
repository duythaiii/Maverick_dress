@extends('master')

<style>@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;800&display=swap');
    div .form-group{
        font-family: Poppins;
        padding-bottom: 10px;
        margin: 7px;
    }

    label {
        margin: 0 0 0 10px;
        font-size: 19px;
    }

    button.btn{
        background-color: rgb(68, 132, 237);
        font-family: Poppins;
        font-size: 18px;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

@section('content')

@if ($errors->any())
<div class="alert alert-primary alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ Session::get('error') }}</strong>
    </div>
@endif 


<table>
    <form action="{{route('admin.cart.update', ['id' => $edits->id])}}" method="post">
        @csrf
        <tr>
            <div class="form-group">
                <label>Code Order</label>
                <input type="text" class="form-control"  style="text-align:center;"name="name" disabled  value="{{$edits->code_order}}">
            </div>
        </tr>
        <tr>
            <div class="form-group">
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name = "status">
                        @php
                        if($edits->status == 1){
                            echo '<option value="1" selected style="text-align: center">Wait for confirmation</option><option value="2" style="text-align: center">Confirmed</option><option value="3" style="text-align: center">Delivery in progress</option><option value="4" style="text-align: center">Giao hàng thành công</option><option value="5"  style="text-align: center">Cancel</option>';
                        }elseif($edits->status == 2){
                            echo '<<option selected value="2" style="text-align: center">Confirmed</option><option value="3" style="text-align: center">Delivery in progress</option><option value="4" style="text-align: center">Delivery successful</option><option value="5"  style="text-align: center">Cancel</option>';
                        }elseif($edits->status == 3){
                            echo '<option value="3" selected style="text-align: center">Delivery in progress</option><option value="4" style="text-align: center">Delivery successful</option><option value="5"  style="text-align: center">Cancel</option>';
                        }elseif($edits->status == 4){
                            echo '<option value="4" disabled  style="text-align: center">Delivery successful</option>';
                        }elseif($edits->status == 6){
                            echo '<option value="6" selected style="text-align: center">Waiting to check the goods</option><option value="7" style="text-align: center">Returns Successfully</option><option value="5"  style="text-align: center">Cancel</option>';
                        }elseif($edits->status == 7){
                            echo '<option value="7"  disabled style="text-align: center">Returns Successfully</option>';
                        }else {
                            echo '</option><option disabled  value="5" style="text-align: center">Cancel</option>';
                        }
                        @endphp
                    </select>
                </div>
            </div>
        </tr>
        <tr>
            <select class="form-control" name="payment" >
                @if($edits->payment == 1)
                <option value="1" selected style="text-align: center">Unpaid</option>
                <option value="2" style="text-align: center">Paid</option>
                @else
                <option value="2" style="text-align: center">Paid</option>
                @endif
            </select>
        </tr>
        <tr>
            <div class="card-footer" style="text-align: center; padding: 20px">
                <button type="submit" class="btn btn-info">Edit</button>
            </div>
        </tr>
    </form>
</table>
@endsection