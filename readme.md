### Tango Rewards as a Service API for PHP


TangoCard RAAS PHP SDK

Refer to Tango Raas API for actual response and requests. https://integration-www.tangocard.com/raas_api_console/v2/

Usage
-----

Initialize the base Tango Object with your API credentials. 

    $tangocard = new TangoCard('PLATFORM_ID','PLATFORM_KEY');

    $tangocard->setAppMode("sandbox"); //Default mode is production.

Valid Values : "production", "sandbox"

Raas API Calls:

All Raas api calls return a stdObject with two properties: status and data
The data property contains the response from the RaaS API as an stdObject.

