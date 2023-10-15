<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paystack payment</title>
</head>

<body>

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
               payWithPaystack();
        });

        function payWithPaystack() {

            let handler = PaystackPop.setup({

                key: "{{config('paystack.public_key')}}", // Replace with your public key

                email: 'user@gmail.com',

                amount: '4000',

                currency: 'NGN',

                onClose: function() {

                    alert('Window closed.');

                },

                callback: function(response) {
                    window.location.href = response.redirecturl
                }

            });


            handler.openIframe();

        }
    </script>
</body>

</html>
