<?php
header("Content-Type: application/xml; charset=UTF-8");

// Sample data to be returned as XML
$data = [
    'item1' => 'value1',
    'item2' => 'value2',
    'item3' => 'value3'
];

// Function to convert array to XML
function array_to_xml($data, &$xml_data) {
    foreach($data as $key => $value) {
        if(is_array($value)) {
            $subnode = $xml_data->addChild("$key");
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key", htmlspecialchars("$value"));
        }
    }
}

// Creating an XML structure
$xml_data = new SimpleXMLElement('<?xml version="1.0"?><response></response>');

// Convert the array to XML
array_to_xml($data, $xml_data);

// Output the XML content
echo $xml_data->asXML();
