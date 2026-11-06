@extends('frontend.layouts.app')

@section('content')

    <form id="paymentEsewa" action='https://uat.esewa.com.np/epay/main' method="POST">
        <input value="{{$data['tAmt']}}" name="tAmt" type="hidden">
        <input value="{{$data['amt']}}" name="amt" type="hidden">
        <input value="{{$data['txAmt']}}" name="txAmt" type="hidden">
        <input value="{{$data['psc']}}" name="psc" type="hidden">
        <input value="{{$data['pdc']}}" name="pdc" type="hidden">
        <input value="{{$data['scd']}}" name="scd" type="hidden">
        <input value="{{$data['pid']}}" name="pid" type="hidden">
        <input value="{{route('payment.esewa.success',['type'=>'esewa','ref'=>$data['pid']])}}" type="hidden" name="su">
        <input value="{{route('payment.esewa.failed',['type'=>'esewa','ref'=>$data['pid']])}}" type="hidden" name="fu">
        <input value="Submit" type="submit">
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("#paymentEsewa").submit();
        });
    </script>
@endsection
