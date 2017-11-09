<?php

require 'functions.php';

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "wieg16";

//Require json array file
//require 'customers.json';

//Decode json
$json = json_decode(file_get_contents('customers.json'), true);

// $json = json_decode(get_webpage('https://www.milletech.se/invoicing/export/customers'), true);

// Create connection

try {
    $pdo = new PDO("mysql:dbname=$dbname;host=$servername", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach($json as $customer) {

        $id = $customer['id'];
        $email = $customer['email'];
        $firstname = $customer['firstname'];
        $lastname = $customer['lastname'];
        $gender = $customer['gender'];
        $customer_activated = $customer['customer_activated'];
        $group_id = $customer['group_id'];
        $customer_company = $customer['customer_company'];
        $default_billing = $customer['default_billing'];
        $default_shipping = $customer['default_shipping'];
        $is_active = $customer['is_active'];
        $created_at = $customer['created_at'];
        $updated_at = $customer['updated_at'];
        $customer_invoice_email = $customer['customer_invoice_email'];
        $customer_extra_text = $customer['customer_extra_text'];
        $customer_due_date_period = $customer['customer_due_date_period'];

        $id_address = $customer['address']['id'];
        $customer_id = $customer['address']['customer_id'];
        $customer_address_id = $customer['address']['customer_address_id'];
        $email_address = $customer['address']['email'];
        $firstname_address = $customer['address']['firstname'];
        $lastname_address = $customer['address']['lastname'];
        $postcode = $customer['address']['postcode'];
        $street = $customer['address']['street'];
        $city = $customer['address']['city'];
        $telephone = $customer['address']['telephone'];
        $country_id = $customer['address']['country_id'];
        $address_type = $customer['address']['address_type'];
        $company = $customer['address']['company'];
        $country = $customer['address']['country'];

        $sqlCustomer = "INSERT INTO customers (id, email, firstname, lastname, gender, customer_activated, 
                group_id, customer_company, default_billing, default_shipping, is_active, created_at, 
                updated_at, customer_invoice_email, customer_extra_text, customer_due_date_period) 
                VALUES ('$id', '$email', '$firstname', '$lastname',
                '$gender', '$customer_activated', '$group_id', '$customer_company', '$default_billing', '$default_shipping',
                '$is_active', '$created_at', '$updated_at', '$customer_invoice_email', '$customer_extra_text', 
                '$customer_due_date_period')";


        $sqlAddress = "INSERT INTO customer_addresses (id, customer_id, customer_address_id,
                      email, firstname, lastname, postcode, street, city, telephone, country_id,
                      address_type, company, country)
                      VALUES ('$id_address', '$customer_id', '$customer_address_id', '$email_address',
                       '$firstname_address', '$lastname_address', '$postcode', '$street', '$city',
                        '$telephone', '$country_id', '$address_type', '$company', '$country')";

        $pdo->exec($sqlCustomer);
        echo "New customer record created successfully for customer ID <strong>$id</strong> // ";

        if (isset($id_address)) {
            $pdo->exec($sqlAddress);
            echo "New address record creation also successfully for this customer.<br>";
        }
        else {
            echo "Shipping address <strong>UNAVAILABLE</strong> for customer ID <strong>$id</strong>.<br>";
        }
    }
}

catch (PDOException $e) {
    echo $sqlCustomer . "<br>" . $e->getMessage();
    echo $sqlAddress . "<br>" . $e->getMessage();
}

$conn = null;


/*
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
*/