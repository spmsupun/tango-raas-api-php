### Tango Rewards as a Service v2 API for PHP 


TangoCard RAAS PHP SDK for RAAS api v2

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

Response Structure:
~~~~
Integrateideas\TangoRaasApi\TangoCardResponse Object
(
    [status] => //contains status of the request : True if api response is 2x else false
    [data] => stdClass Object
        (
        	//contains requested data
        )
)
~~~~
1) Get a list of all Customers
		
		$tangoCard->getCustomers();


2) Create a new Customer
		
		$tangoCard->createCustomer($customerIdentifier,$displayName);


3) Get details for a specific Customer

		$tangoCard->getCustomerInfo($customerIdentifier);


4) Get a list of all Accounts created for a specific Customer

		$tangoCard->getCustomerAccounts($customerIdentifier);


5) Create an Account under a specific Customer
	
		$tangoCard->createCustomerAccount($customerIdentifier,$contactEmail,$displayName,$accountIdentifier);

6) Get a list of Accounts

		$tangoCard->getAccountList();


7) Get details for a specific Account

		$tangoCard->getAccountDetail($accountIdentifier);


8) Fund an Account

		$tangoCard->fundAccount($customerIdentifier,$accountIdentifier,$creditCardToken,$amount);


9) Unregister a Credit Card

		$tangoCard->unregisterCreditCard($customerIdentifier,$accountIdentifier,$creditCardToken);


10) List all credit cards

		$tangoCard->getCreditCardList();


11) Register a new Credit Card

		$tangoCard->registerCreditCard($customerIdentifier,$accountIdentifier,$cardNumber,$verificationNumber,$expiration,$firstName,$lastName,$emailAddress,$addressLine1,$addressLine2,$city,$state,$postalCode,$country,$ipAddress,$label);


12) Get details for a specific Credit Card

		$tangoCard->getCreditCardDetail($creditCardToken);


13) Get all items in the Platform's Catalog

		$tangoCard->getCatalogs();


14) Get a list of Orders

		$tangoCard->getOrderList();


15) Create an Order under a specific Account

		$tangoCard->placeOrder($customerIdentifier,$accountIdentifier,$amount,$utid,$sendEmail,$recipientEmail,$recipientFirstName,$recipientLastName,$campaign,$emailSubject,$message,$notes,$senderEmail,$senderFirstName,$senderLastName,$externalRefID);


16) Get details for a specific Order

		$tangoCard->getOrderDetail($refOrderId);


17) Resend a specific Order

		$tangoCard->resendOrder($referenceOrderID);


