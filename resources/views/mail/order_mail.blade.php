<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center; /* Align content vertically center */
        }

        .logo {
            max-width: 200px;
            margin-bottom: 20px; /* Adjust margin as needed */
        }

        h1 {
            color: #333;
            text-align: center;
        }

        p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ asset('frontend/assets/imgs/theme/logo.svg') }}" alt="Alostab Vendors" class="logo">
        <h1>Hello!! {{ $order['name'] }}</h1>
        <h2>You are receiving this email from Alostab Vendors. </h2>
        <h4>We are happy to announce that your order has been successfully placed.</h4>
        <table>
            <tr>
                <td>Invoice No:</td>
                <td>{{ $order['invoice_no'] }}</td>
            </tr>
            <tr>
                <td>Amount:</td>
                <td>Rs. {{ $order['amount'] }}</td>
            </tr>
            <tr>
                <td>Name:</td>
                <td>{{ $order['name'] }}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{ $order['email'] }}</td>
            </tr>
            <tr>
                <td>Address:</td>
                <td>{{ $order['address'] }}</td>
            </tr>
            <tr>
                <td>Order Date:</td>
                <td>{{ $order['order_date'] }}</td>
            </tr>
        </table>
        <div class="footer">
            <p>&copy; 2024 Alostab Vendors. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
