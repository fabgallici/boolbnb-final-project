@extends('layouts.base')
@section('hosted')

<main class="main-payment py-5">
    <div class="payment col-7 col-xl-5 m-auto">
        <div class="payment__wrap p-4">
                <h2 class="text-center">Payment Form</h2>
                <div class="spacer"></div>

                <form action="{{route('payment.make',[$apartment ->id,Request::get('ads')])}}" method="POST" id="my-sample-form">
                        @csrf
                        @method('POST')
                        <label for="email" class="col-form-label">Indirizzo Email</label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" name="email" value="{{ Auth::user() -> email }}" required autocomplete="off">

                        <div class="form-group">
                            <label for="name_on_card">Name on Card</label>
                            <input type="text" class="form-control" id="name_on_card" name="name_on_card">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <input type="text" class="form-control" id="province" name="province">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="postalcode">Postal Code</label>
                                    <input type="text" class="form-control" id="postalcode" name="postalcode">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="text" class="form-control" id="amount" name="amount" value="{{$price/100}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label id="label-cc" for="cc_number">Credit Card Number</label>

                                <div class="form-group" id="card-number">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="expiry">Expiry</label>

                                <div class="form-group" id="expiration-date">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cvv">CVV</label>

                                <div class="form-group" id="cvv">

                                </div>
                            </div>

                        </div>

                        <div class="spacer"></div>

                        <div class="spacer"></div>

                        <div class="text-right">
                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                            <button type="submit" class="btn btn-success bh-btn-success" >Submit Payment</button>
                        </div>
                    </form>
                    </div>

    </div>
</main>

<script src="https://js.braintreegateway.com/web/3.57.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.57.0/js/hosted-fields.min.js"></script>
<script>
    var form = document.querySelector('#my-sample-form');
    var submit = document.querySelector('input[type="submit"]');

    braintree.client.create({
        authorization: 'sandbox_24rsfnxv_8w4hz737npfm33s6'
    },

    function (clientErr, clientInstance) {
        if (clientErr) {
        //console.error(clientErr);
        return;
        }

        // This example shows Hosted Fields, but you can also use this
        // client instance to create additional components here, such as
        // PayPal or Data Collector.

        braintree.hostedFields.create({
        client: clientInstance,
        styles: {
            'input': {
            'font-size': '14px'
            },
            'input.invalid': {
            'color': 'red'
            },
            'input.valid': {
            'color': 'green'
            }
        },
        fields: {
            number: {
            selector: '#card-number',
            placeholder: '4111 1111 1111 1111'
            },
            cvv: {
            selector: '#cvv',
            placeholder: '123'
            },
            expirationDate: {
            selector: '#expiration-date',
            placeholder: '12/2020'
            }
        }
        },
        function (hostedFieldsErr, hostedFieldsInstance) {
        if (hostedFieldsErr) {
            //console.error(hostedFieldsErr);
            return;
        }

        //submit.removeAttribute('disabled');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
            if (tokenizeErr) {
                console.error(tokenizeErr);
                return;
            }

            // If this was a real integration, this is where you would
            // send the nonce to your server.
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
            //console.log('Got a nonce: ' + payload.nonce);

            });
        }, false);
        },);
    });
</script>


@endsection
