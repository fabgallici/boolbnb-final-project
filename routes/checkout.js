var checkout = require('./routes/checkout');
app.use('/checkout', checkout);

var express = require('express');
var router = express.Router();
var braintree = require('braintree');

router.post('/', function (req, res, next) {
    var gateway = braintree.connect({
        environment: braintree.Environment.Sandbox,
        // Use your own credentials from the sandbox Control Panel here
        merchantId: '8w4hz737npfm33s6',
        publicKey: 'mq73dj8hqrtn4pvx',
        privateKey: 'dbad4bb9942aadf39b167d980dcb0893'
    });

    // Use the payment method nonce here
    var nonceFromTheClient = req.body.paymentMethodNonce;
    // Create a new transaction for $10
    var newTransaction = gateway.transaction.sale({
        amount: '10.00',
        paymentMethodNonce: nonceFromTheClient,
        options: {
            // This option requests the funds from the transaction
            // once it has been authorized successfully
            submitForSettlement: true
        }
    }, function (error, result) {
        if (result) {
            res.send(result);
        } else {
            res.status(500).send(error);
        }
    });
});

module.exports = router;