<?php

// start loading of vendors
require __DIR__ . '/vendor/autoload.php';
// end loading of vendors

// create google api client
$client = new \Google_Client();


// using client object set the application name 
$client->setApplicationName('Test Googlesheet Data To PHP');

//set scopes
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);

// set access type if can be offline or online
$client->setAccessType('offline');

// set the authorization configurations using the json credentials download from google console site
$client->setAuthConfig(__DIR__ . '/api_key.json');

//Create google sheets service object
$service = new Google_Service_Sheets($client); // <-- we pass the client object that we created above

// set access for the sheets ID 
$spreadsheetId = "1OZhxUNvYYE6-VLQqQQjtuWS3RsjD5HtZKE2oNFPxFhc"; // can be seen in the url when the sheet is opened

// create a range to read in the spreadsheet
$range = "DS_1!A1:C4"; // format is name_of_sheet!first_column:last_column

// use the service to get the values of the spreadheet id with range and pass it to response
$response = $service->spreadsheets_values->get($spreadsheetId, $range);

// get the values
$values = $response->getValues();

//check if data exists and if not display data

//start loop for checking of data
if(empty($values)){

    echo "Data does not exist. Try checking the sheet ID and Permissions";

} else {
     $mask = "%10s %-10s %s\n"; // display the 10 characters in the first, 10 in the second and print the rest
     
     // loop through values because it contains the data to be displayed
     foreach ($values as $val){

        echo sprintf($mask, $val[0], $val[1], $val[2]);

    }
     // end looping through values

} 
// end loop for check of data


?>