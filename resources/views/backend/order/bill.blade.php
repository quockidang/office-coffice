<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="justify-content-center ">
        <img src="{{asset('img/office_logo.png')}}" width="100%" height="100%">
        <p class="text-center" style="margin-bottom: 0px">{{$order->store_code}}</p>
        <p class="text-center" style="margin-bottom: 0px">SĐT: 028 668 66 669 - Fb/OfficeCoffeeVietNam</p>
        <h5 style="margin-bottom: 0px" class="font-weight-bold text-center">HÓA ĐƠN THANH TOÁN</h5>
        <table class="table table-sm">
            <thead style="border-bottom: solid 1px; border-top: none" class="thead">
                <tr style="margin-right: 4px; font-size: 10px">
                    <th>TT</th>
                    <th>Tên món</th>
                    <th>SL</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $key => $item)
                <tr style="font-size: 8px">
                    <td>{{$key + 1}}</td>
                    <td>{{$item->product_id->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{number_format($item->price)}}</td>
                    <td>{{number_format($item->price * $item->quantity)}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">Thành tiền</td>
                    <td>123</td>
                </tr>
                <tr>
                        <td colspan="4">Tổng cộng: </td>
                        <td>123</td>
                    </tr>
            </tbody>
        </table>

        <p  style="margin-bottom: 0px" class="text-center font-weight-bold">Giá đã bao gồm thuế 10% VAT</p>
        <p  style="margin-bottom: 0px" class="text-center font-weight-bold">Giá đã bao gồm thuế 10% VAT</p>
        <p  style="margin-bottom: 0px" class="text-center font-weight-bold">Giá đã bao gồm thuế 10% VAT</p>
        <p  style="margin-bottom: 0px" class="text-center font-weight-bold">Giá đã bao gồm thuế 10% VAT</p>
        <p  style="margin-bottom: 0px" class="text-center font-weight-bold">Giá đã bao gồm thuế 10% VAT</p>

        

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
