<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #008181;
            color: white;
        }
        .invoice-header {
            background-color: #f2f2f2;
            padding: 10px 20px;
        }
        .invoice-details {
            /* background-color: #f9f9f9; */
            background-color: #f2f2f2;
            padding: 10px 20px;
        }
        .invoice-products {
            background-color: #f2f2f2;
            padding: 10px 20px;
        }
        .total-section {
            padding: 20px;
            text-align: right;
        }
        .thanks {
            color: #050047;
            font-size: 18px;
            margin-top: 5px;
            margin-bottom: 30px;
        }
        .authority {
            text-align: right;
            margin-top: 20px;
        }
        .authority h5 {
            color: #07002d;
        }
        .pad {
            padding-bottom: 20px;
        }
        .left-align {
            text-align: left;
        }
        .right-align {
            text-align: right;
        }
        .right-align p{
            margin-bottom: 10px;
        }
        .cont{
            padding: 0 30px;
        }
    </style>
</head>
<body>

<table class="invoice-header">
    <tr>
        <td class="left-align" colspan="2">
            <img src="{{ public_path('frontend/assets/imgs/theme/myLogo.png') }}" alt="LOGO" width="150"/><br>
            <h2>Alostab Vendors</h2>
        </td>
        <td class="right-align">
            <p>
                Email: alostabvendors@gmail.om<br>
                Contact No: +977 9862394599<br>
                Address: Pokhara, Fulbari-11, Nepal
            </p>
        </td>
    </tr>
</table>

<table class="invoice-details">
    <tr>
        <td>
            <p class="pad">
                <strong>Name:</strong> {{ $order->name }} <br>
                <strong>Email:</strong> {{ $order->email }} <br>
                <strong>Phone:</strong> {{ $order->phone }} <br>
                @php 
                    $dis = $order->District->district_name;
                    $city = $order->City->city_name;
                    $state = $order->State->state_name;
                @endphp
                <strong>Address:</strong> {{ $order->address }} / {{ $dis }} /{{ $city }} / {{ $state }}<br>
            </p>
        </td>
        <td>
            <p class="pad">
                <strong>Invoice No:</strong><span style="color: #ff0000;"> {{ $order->invoice_number }}</span><br>
                <strong>Order Date:</strong> {{ $order->order_date }} <br>
                <strong>Delivery Date:</strong> {{ $order->delivery_date }} <br>
                <strong>Payment Method:</strong> {{ $order->payment_method }} <br>
            </p>
        </td>
    </tr>
</table>
<table class="invoice-products">
    <h3>Products</h3>
    <thead>
    <tr>
        <th>Image</th>
        <th>Product Name</th>
        <th>Size</th>
        <th>Color</th>
        <th>Code</th>
        <th>Vendor Name </th>
        <th>Quantity</th>
        <th>Total </th>
    </tr>
    </thead>
    <tbody>
    @foreach($orderItem as $item)
        <tr>
            <td align="center">
                <img src="{{ public_path($item->product->product_thumbnail) }}" height="50" alt="">
            </td>
            <td align="center">{{ $item->product->product_name }}</td>
            <td align="center">{{ $item->size ?? 'N/A' }}</td>
            <td align="center">{{ $item->color ?? 'N/A' }}</td>
            <td align="center">{{ $item->product->product_code }}</td>
            <td align="center">{{ $item->vendor_id ? $item->product->vendor->name : 'Owner' }}</td>
            <td align="center">{{ $item->qty }}</td>
            <td align="center">Rs.{{ $item->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="total-section">
    <h3><span style="color:  #931814;">Subtotal:</span> Rs. {{ $order->amount }}</h3>
    <h3><span style="color: #931814;">Total:</span> Rs. {{ $order->amount }}</h3>
    {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
</div>

<div class="thanks cont">
    <strong><p>Thank You For Buying Our Products..!!</p></strong>
</div>

<div class="authority right-align cont">
    <p>------------------------</p>
    <h5>Authority Signature</h5>
</div>

</body>
</html>
