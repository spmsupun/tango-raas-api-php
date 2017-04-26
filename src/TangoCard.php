<?php
namespace Integrateideas\TangoRaasApi;

use Integrateideas\TangoRaasApi\TangoCardBase;

/**
 *    The MIT License (MIT)
 *
 *    Copyright 2017 Twinspark Technology and consulting LLP.
 *
 *    Permission is hereby granted, free of charge, to any person obtaining a copy
 *    of this software and associated documentation files (the "Software"), to deal
 *    in the Software without restriction, including without limitation the rights
 *    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *    copies of the Software, and to permit persons to whom the Software is
 *    furnished to do so, subject to the following conditions:
 *
 *    The above copyright notice and this permission notice shall be included in all
 *    copies or substantial portions of the Software.
 *
 *    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *    SOFTWARE.

 */
class TangoCard extends TangoCardBase {

  /**
     * The Application Mode.
     *
     * @var string
     */
  protected $appMode = "production";

    /**
     * The Platform Name provided by Tangocard.
     *
     * @var string
     */
    protected $platformName;

    /**
     * The Platform Key provided by Tangocard.
     *
     * @var string
     */
    protected $platformKey;

    /**
     * $appVersion defines tangocard RAAS api version
     *
     * @var string
     */
    protected $tangoCardApiVersion = 'v2';




    /**
     * set application Configurations.
     */

    /**
     * Set the Application Mode.
     *
     * @param string $appMode The application mode
     *
     * @return BaseTangoCard
     */
    public function setAppMode($appMode) {
        if (in_array($appMode, array_keys(self::$_appModes)))
            $this->appMode = $appMode;
        else
            throw new TangoCardAppModeInvalidException();

        return $this;
    }

    /**
     * Get the Applicaton Mode.
     *
     * @return string the application Mode
     */
    public function getAppMode() {
        return $this->appMode;
    }

    /**
     * Set the Tango Card Api Version.
     *
     * @param string $apiVersion contains TangoCard Raas Api version
     *
     * @return BaseTangoCard
     */
    public function setTangoCardApiVersion($apiVersion) {
        $this->tangoCardApiVersion = $apiVersion;
        return $this;
    }

    /**
     * Get the Tango Card Api Version.
     *
     * @return string the Tangocard RAAS api version
     */
    public function getTangoCardApiVersion() {
        return $this->tangoCardApiVersion;
    }

    /**
     * Set the Platform Name.
     *
     * @param string $platformName The platform Name provided by Tango Card
     *
     * @return BaseTangoCard
     */
    public function setPlatformName($platformName) {
        $this->platformName = $platformName;
        return $this;
    }

    /**
     * Get the Platform Name.
     *
     * @return string the Platform Name provided by Tango Card
     */
    public function getPlatformName() {
        return $this->platformName;
    }

    /**
     * Set the Platform key.
     *
     * @param string $platformKey The Platform Key  (app secret) Provided by Tango Card
     *
     * @return BaseTangoCard
     */
    public function setPlatformKey($platfromKey) {
        $this->platformKey = $platfromKey;
        return $this;
    }

    /**
     * Get the Platform Key.
     *
     * @return string The Platform key (app secret) provided by Tango Card
     */
    public function getPlatformKey() {
        return $this->platformKey;
    }

    /**
     * Constructor
     * @param string $platformName The platform Name provided by Tango Card
     * @param string $platformKey The Platform Key  (app secret) Provided by Tango Card
     */
    public function __construct($platformName, $platformKey) {
        $this->setPlatformName($platformName);
        $this->setPlatformKey($platformKey);
    }

    /**
     * Get a list of all Customers.
     *
     * @return array Customers List
     */
    public function getCustomers() {
        return parent::_requestData('get','customers');
    }

    /**
     * Get details for a specific Customer
     *
     * @param string $customerIdentifier customerIdentifier
     *
     * @return array Customer Detail
     */
    public function getCustomerInfo($customerIdentifier) {
        return parent::_requestData('get','customers',$customerIdentifier);
    }

    /**
     * Get a list of all Accounts created for a specific Customer
     *
     * @param string $customerIdentifier customerIdentifier
     *
     * @return array Customers Accounts
     */
       public function getCustomerAccounts($customerIdentifier) {
        return parent::_requestData('get','customers',$customerIdentifier,'accounts');
    }

    /**
     * Get a list of Accounts
     *
     * @return array Account List
     */
    public function getAccountList() {
        return parent::_requestData('get','accounts');
    }

    /**
     * Get details for a specific Account
     *
     * @param string $accountIdentifier accountIdentifier
     *
     * @return array Account Detail
     */
    public function getAccountDetail($accountIdentifier) {
        return parent::_requestData('get','accounts',$accountIdentifier);
    }
    /**
     * Get all items in the Platform's Catalog
     *
     * @return array Registered Credit Card List
     */
    public function getCreditCardList() {
        return parent::_requestData('get','creditCards');
    }
    /**
     * Get details for a specific Credit Card.
     *
     * @param string $creditCardToken Credit card token
     *
     * @return array Specific Credit Card Detail
     */
    public function getCreditCardDetail($creditCardToken) {
        return parent::_requestData('get','creditCards',$creditCardToken);
    }
     /**
     * Get all items in the Platform's Catalog
     *
     * @return array all items in the Platform's Catalog
     */
    public function getCatalogs() {
        return parent::_requestData('get','catalogs');
    }
     /**
     * Get a list of Orders placed
     *
     * @return array Get a list of Orders placed
     */
    public function getOrderList() {
        return parent::_requestData('get','orders');
    }

     /**
     * Get details for a specific Order
     *
     * @param string $refOrderId Reference order ID is returned in the order response payload
     *
     * @return array details for a specific Order
     */
    public function getOrderDetail($refOrderId) {
        return parent::_requestData('get','orders',$refOrderId);
    }


     /**
     * Create a new Customer
     *
     * @param string $customerIdentifier an official identifier for this customer. This identifier needs to be lowercase if alphabetic characters are used.
     * @param string $displayName a friendly name for this customer
     *
     * @return array details of created customer
     */
    public function createCustomer($customerIdentifier,$displayName) {
        $data =[
        'customerIdentifier'=>$customerIdentifier,
        'displayName'=>$displayName
        ];
        return parent::_requestData('post','customers',false,false,$data);
    }
    /**
     * Create an Account under a specific Customer
     *
     * @param string $customerIdentifier The customerIdentifier for the Customer under which you are creating a new account
     * @param string $contactEmail An email address for a designated representative for this account.
     * @param string $accountIdentifier A unique identifier for this account. This identifier must be lowercase if alphabetic characters are used.
     * @param string $displayName  A friendly name for this account
     *
     * @return array details of created account
     */
    public function createCustomerAccount($customerIdentifier,$contactEmail,$displayName,$accountIdentifier) {
        $data =[
        'contactEmail'=>$contactEmail,
        'displayName'=>$displayName,
        'accountIdentifier'=>$accountIdentifier
        ];
        return parent::_requestData('post','customers',$customerIdentifier,'accounts',$data);
    }

    /**
     * Register a new Credit Card
     *
     * @param string $customerIdentifier specify the customer associated with the credit card. Must be the customer the accountIdentifier is associated with.
     * @param string $accountIdentifier specify the account this credit card is associated with
     * @param string $cardNumber (credit card number) specify the account this order will be deducted from
     * @param string $verificationNumber  specify the 3 or 4-digit card security code on back of card (CVV2, CVC2, or CID)
     * @param string $expiration   specify the card expiration date in YYYY-MM format
     * @param string $firstName  specify the billing address first name
     * @param string $lastName  specify the billing address last name
     * @param string $emailAddress specify the billing address email
     * @param string $addressLine1  specify the billing address line 1
     * @param string $addressLine2  Optional. Specify the billing address line 2
     * @param string $city  specify the billing address city
     * @param string $state   specify the billing address state
     * @param string $postalCode  specify the billing address postal code
     * @param string $country specify the billing address 2-letter country code
     * @param string $ipAddress  specify the The IP address of the person adding the credit card
     * @param string $label specify a label for the credit card
     *
     *
     * @return array details of register credit card
     */
    public function registerCreditCard($customerIdentifier,$accountIdentifier,$cardNumber,$verificationNumber,$expiration,$firstName,$lastName,$emailAddress,$addressLine1,$addressLine2,$city,$state,$postalCode,$country,$ipAddress,$label) {
        $data =[
        'accountIdentifier'=>$accountIdentifier,
        'customerIdentifier'=>$customerIdentifier,
        'ipAddress'=>$ipAddress,
        'label'=>$label,
        'billingAddress'=>[
        'firstName'=>$firstName,
        'lastName'=>$lastName,
        'emailAddress'=>$emailAddress,
        'addressLine1'=>$addressLine1,
        'addressLine2'=>$addressLine2,
        'city'=>$city,
        'state'=>$state,
        'postalCode'=>$postalCode,
        'country'=>$country
        ],
        'creditCard'=>[
        'expiration'=>$expiration,
        'number'=>$cardNumber,
        'verificationNumber'=>$verificationNumber
        ]
        ];
        return parent::_requestData('post','creditCards',false,false,$data);
    }
    /**
     * Fund an Account
     *
     * @param string $customerIdentifier specify the customer associated with the credit card. Must be the customer the accountIdentifier is associated with.
     * @param string $accountIdentifier specify the account this credit card is associated with
     * @param string $creditCardToken specify the credit card token to fund with
     * @param string $amount  specify the amount to fund in USD
     *
     * @return array details of allocated fund
     */
    public function fundAccount($customerIdentifier,$accountIdentifier,$creditCardToken,$amount) {
        $data =[
        'accountIdentifier'=>$accountIdentifier,
        'customerIdentifier'=>$customerIdentifier,
        'creditCardToken'=>$creditCardToken,
        'amount'=>$amount
        ];
        return parent::_requestData('post','creditCardDeposits',false,false,$data);
    }
    /**
     * Unregister a Credit Card.
     *
     * @param string $customerIdentifier specify the customer associated with the credit card. Must be the customer the accountIdentifier is associated with.
     * @param string $accountIdentifier specify the account this credit card is associated with
     * @param string $creditCardToken specify the credit card token to fund with
     *
     * @return array response
     */
    public function unregisterCreditCard($customerIdentifier,$accountIdentifier,$creditCardToken) {
        $data =[
        'accountIdentifier'=>$accountIdentifier,
        'customerIdentifier'=>$customerIdentifier,
        'creditCardToken'=>$creditCardToken
        ];
        return parent::_requestData('post','creditCardUnregisters',false,false,$data);
    }
     /**
     * Create an Order under a specific Account.
     *
     * @param string $customerIdentifierspecify the customer associated with the order. Must be the customer the accountIdentifier is associated with.
     * @param string $accountIdentifier specify the account this order will be deducted from
     * @param string $amount specify the face value of of the reward. Always required, including for fixed value items.
     * @param string $utid the unique identifier for the reward you are sending as provided in the Get Catalog call
     * @param string $sendEmail should Tango Card send the email to the recipient?
     * @param string $recipientEmail recipient Email:required if sendEmail is true
     * @param string $recipientFirstName recipient first name: required if sendEmail is true (100 character max)
     * @param string $recipientLastName  recipient last name:always optional (100 character max)
     * @param string $campaign optional campaign that may be used to administratively categorize a specific order or, if applicable, call a designated campaign email template.
     * @param string $emailSubject Optional. If not specified, a default email subject will be used for the specified reward.
     * @param string $message optional gift message
     * @param string $notes Optional order notes (up to 150 characters)
     * @param string $senderFirstName sender's first name: required if sendEmail is true (100 character max)
     * @param string $senderLastName sender's last name:always optional (100 character max)
     * @param string $senderEmail sender's Email:always optional
     * @param string $externalRefID Optional. Idempotenent field that can be used for client-side order cross reference and prevent accidental order duplication. Will be returned in order response, order details, and order history.
     *
     *
     * @return array created order response
     */
    public function placeOrder($customerIdentifier,$accountIdentifier,$amount,$utid,$sendEmail,$recipientEmail,$recipientFirstName,$recipientLastName=null,$campaign=null,$emailSubject=null,$message=null,$notes=null,$senderEmail=null,$senderFirstName=null,$senderLastName=null,$externalRefID=null) {
        $data =[
        'accountIdentifier'=>$accountIdentifier,
        'customerIdentifier'=>$customerIdentifier,
        'amount'=>$amount,
        'campaign'=>$campaign,
        'emailSubject'=>$emailSubject,
        'externalRefID'=>$externalRefID,
        'message'=>$message,
        'notes'=>$notes,
        'utid'=>$utid,
        'sendEmail'=>$sendEmail,
        'recipient'=>[
        'email'=>$recipientEmail,
        'firstName'=>$recipientFirstName,
        'lastName'=>$recipientLastName
        ],
        'sender'=>[
        'email'=>$senderEmail,
        'firstName'=>$senderFirstName,
        'lastName'=>$senderLastName
        ]
        ];
        return parent::_requestData('post','orders',false,false,$data);
    }

     /**
     * Resend a specific Order
     *
     * @param string $referenceOrderID Reference order ID is returned in the order response payload
     *
     * @return array response
     */
    public function resendOrder($referenceOrderID) {
        return parent::_requestData('post','orders',$referenceOrderID,'resends');
    }

}
?>
