<?php 
    require_once('vendor/autoload.php');

    \Stripe\Stripe::setApiKey('sk_test_aKexN4C3AABv3tdhx3LSJbNo');

    $POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);

    $first_name = $POST['first_name'];
    $last_name = $POST['last_name'];
    $email = $POST['email'];
    $token = $POST['stripeToken'];

    //Create Customer in stripe
    $customer = \Stripe\Customer::create(array(
        "email" => $email,
        "source" => $token
    ));

    //Charge the Customer

    $charge = \Stripe\Charge::create(array(
        "amount" => 5000,
        "currency" => "try",
        "description" => 'You Dont Know Javascript Ebook',
        "customer" => $customer->id
    ));

    //Redirect to success
    header('Location:success.php?tid='.$charge->id."&product=".$charge->description);
?>