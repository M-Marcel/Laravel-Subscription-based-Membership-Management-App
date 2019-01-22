<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
        @csrf
        <div class="container">
            <div class="row" style="margin-bottom:40px;">
                <div class="col-md-8 col-md-offset-2">
                    <p>
                        <div class="jumbotron">
                            Membership Registration Fee
                            ₦ 
                        
                        </div>
                    </p>
                    <input type="hidden" name="email" value="{{ $data->email }}"> {{-- required --}}
                    {{--  <input type="hidden" name="first_name" value="marcellus"> 
                    <input type="hidden" name="last_name" value="vincent">   --}}
                    {{-- <input type="hidden" name="plan" value="Membership Registration"> required --}}
                    <input type="hidden" name="orderID" value="345">
                    <input type="hidden" name="amount" value="700000"> {{-- required in kobo --}}
                    <input type="hidden" name="quantity" value="3">
                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['first_name' => $data->first_name, 'last_name' => $data->last_name, 'phone' => $data->phone, 'payment_purpose' => 'Registration Payment']) }}" >
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                    
            
                    <p>
                    <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                    <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                    </button>
                    </p>
                </div>
            </div>
        </div>    
    </form>    
</body>
</html>
