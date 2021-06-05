<?php

namespace Integrateideas\TangoRaasApi;

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
class TangoCard extends TangoCardBase
{

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
    protected string $platformName;

    /**
     * The Platform Key provided by Tangocard.
     *
     * @var string
     */
    protected string $platformKey;

    /**
     * $appVersion defines tangocard RAAS api version
     *
     * @var string
     */
    protected string $tangoCardApiVersion = 'v2';


    /**
     * set application Configurations.
     */

    /**
     * Set the Application Mode.
     *
     * @param string $appMode The application mode
     *
     * @return TangoCard
     * @throws TangoCardAppModeInvalidException
     */
    final public function setAppMode(string $appMode): TangoCard
    {
        if (in_array($appMode, array_keys(self::$_appModes))) {
            $this->appMode = $appMode;
        } else {
            throw new TangoCardAppModeInvalidException();
        }

        return $this;
    }

    /**
     * Get the Application Mode.
     *
     * @return string the application Mode
     */
    final public function getAppMode(): string
    {
        return $this->appMode;
    }

    /**
     * Set the Tango Card Api Version.
     *
     * @param string $apiVersion contains TangoCard Raas Api version
     *
     * @return TangoCard
     */
    final public function setTangoCardApiVersion(string $apiVersion): TangoCard
    {
        $this->tangoCardApiVersion = $apiVersion;
        return $this;
    }

    /**
     * Get the Tango Card Api Version.
     *
     * @return string the Tangocard RAAS api version
     */
    final public function getTangoCardApiVersion(): string
    {
        return $this->tangoCardApiVersion;
    }

    /**
     * Set the Platform Name.
     *
     * @param string $platformName The platform Name provided by Tango Card
     *
     * @return TangoCard
     */
    final public function setPlatformName(string $platformName): TangoCard
    {
        $this->platformName = $platformName;
        return $this;
    }

    /**
     * Get the Platform Name.
     *
     * @return string the Platform Name provided by Tango Card
     */
    final public function getPlatformName(): string
    {
        return $this->platformName;
    }

    /**
     * Set the Platform key.
     *
     * @param string $platformKey The Platform Key  (app secret) Provided by Tango Card
     *
     * @return TangoCard
     */
    final public function setPlatformKey(string $platformKey): TangoCard
    {
        $this->platformKey = $platformKey;
        return $this;
    }

    /**
     * Get the Platform Key.
     *
     * @return string The Platform key (app secret) provided by Tango Card
     */
    final public function getPlatformKey(): string
    {
        return $this->platformKey;
    }

    /**
     * Constructor
     * @param string $platformName The platform Name provided by Tango Card
     * @param string $platformKey The Platform Key  (app secret) Provided by Tango Card
     */
    final public function __construct(string $platformName, string $platformKey)
    {
        $this->setPlatformName($platformName);
        $this->setPlatformKey($platformKey);
    }

    /**
     * Get a list of all Customers.
     *
     * @return TangoCardResponse Customers List
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function getCustomers(): TangoCardResponse
    {
        return parent::_requestData('get', 'customers');
    }

    /**
     * Get details for a specific Customer
     *
     * @param string $customerIdentifier customerIdentifier
     *
     * @return TangoCardResponse Customer Detail
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function getCustomerInfo(string $customerIdentifier): TangoCardResponse
    {
        return parent::_requestData('get', 'customers', $customerIdentifier);
    }

    /**
     * Get a list of all Accounts created for a specific Customer
     *
     * @param string $customerIdentifier customerIdentifier
     *
     * @return TangoCardResponse Customers Accounts
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function getCustomerAccounts(string $customerIdentifier): TangoCardResponse
    {
        return parent::_requestData('get', 'customers', $customerIdentifier, 'accounts');
    }

    /**
     * Get a list of Accounts
     *
     * @return TangoCardResponse Account List
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function getAccountList(): TangoCardResponse
    {
        return parent::_requestData('get', 'accounts');
    }

    /**
     * Get details for a specific Account
     *
     * @param string $accountIdentifier accountIdentifier
     *
     * @return TangoCardResponse Account Detail
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function getAccountDetail(string $accountIdentifier): TangoCardResponse
    {
        return parent::_requestData('get', 'accounts', $accountIdentifier);
    }

    /**
     * Get all items in the Platform's Catalog
     *
     * @return TangoCardResponse Registered Credit Card List
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function getCreditCardList(): TangoCardResponse
    {
        return parent::_requestData('get', 'creditCards');
    }

    /**
     * Get details for a specific Credit Card.
     *
     * @param string $creditCardToken Credit card token
     *
     * @return TangoCardResponse Specific Credit Card Detail
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function getCreditCardDetail(string $creditCardToken): TangoCardResponse
    {
        return parent::_requestData('get', 'creditCards', $creditCardToken);
    }

    /**
     * Get all items in the Platform's Catalog
     *
     * @return TangoCardResponse all items in the Platform's Catalog
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function getCatalogs(): TangoCardResponse
    {
        return parent::_requestData('get', 'catalogs');
    }

    /**
     * Get a list of Orders placed
     *
     * @return TangoCardResponse Get a list of Orders placed
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function getOrderList(): TangoCardResponse
    {
        return parent::_requestData('get', 'orders');
    }

    /**
     * Get details for a specific Order
     *
     * @param string $refOrderId Reference order ID is returned in the order response payload
     *
     * @return TangoCardResponse details for a specific Order
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function getOrderDetail(string $refOrderId): TangoCardResponse
    {
        return parent::_requestData('get', 'orders', $refOrderId);
    }


    /**
     * Create a new Customer
     *
     * @param string $customerIdentifier an official identifier for this customer. This identifier needs to be lowercase if alphabetic characters are used.
     * @param string $displayName a friendly name for this customer
     *
     * @return TangoCardResponse details of created customer
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function createCustomer(string $customerIdentifier, string $displayName): TangoCardResponse
    {
        $data = [
            'customerIdentifier' => $customerIdentifier,
            'displayName' => $displayName
        ];
        return parent::_requestData('post', 'customers', false, false, $data);
    }

    /**
     * Create an Account under a specific Customer
     *
     * @param string $customerIdentifier The customerIdentifier for the Customer under which you are creating a new account
     * @param string $contactEmail An email address for a designated representative for this account.
     * @param string $accountIdentifier A unique identifier for this account. This identifier must be lowercase if alphabetic characters are used.
     * @param string $displayName A friendly name for this account
     *
     * @return TangoCardResponse details of created account
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function createCustomerAccount(
        string $customerIdentifier,
        string $contactEmail,
        string $displayName,
        string $accountIdentifier
    ): TangoCardResponse {
        $data = [
            'contactEmail' => $contactEmail,
            'displayName' => $displayName,
            'accountIdentifier' => $accountIdentifier
        ];
        return parent::_requestData('post', 'customers', $customerIdentifier, 'accounts', $data);
    }

    /**
     * Register a new Credit Card
     *
     * @param string $customerIdentifier specify the customer associated with the credit card. Must be the customer the accountIdentifier is associated with.
     * @param string $accountIdentifier specify the account this credit card is associated with
     * @param string $cardNumber (credit card number) specify the account this order will be deducted from
     * @param string $verificationNumber specify the 3 or 4-digit card security code on back of card (CVV2, CVC2, or CID)
     * @param string $expiration specify the card expiration date in YYYY-MM format
     * @param string $firstName specify the billing address first name
     * @param string $lastName specify the billing address last name
     * @param string $emailAddress specify the billing address email
     * @param string $addressLine1 specify the billing address line 1
     * @param string $addressLine2 Optional. Specify the billing address line 2
     * @param string $city specify the billing address city
     * @param string $state specify the billing address state
     * @param string $postalCode specify the billing address postal code
     * @param string $country specify the billing address 2-letter country code
     * @param string $ipAddress specify the The IP address of the person adding the credit card
     * @param string $label specify a label for the credit card
     *
     *
     * @return TangoCardResponse details of register credit card
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function registerCreditCard(
        string $customerIdentifier,
        string $accountIdentifier,
        string $cardNumber,
        string $verificationNumber,
        string $expiration,
        string $firstName,
        string $lastName,
        string $emailAddress,
        string $addressLine1,
        string $addressLine2,
        string $city,
        string $state,
        string $postalCode,
        string $country,
        string $ipAddress,
        string $label
    ): TangoCardResponse {
        $data = [
            'accountIdentifier' => $accountIdentifier,
            'customerIdentifier' => $customerIdentifier,
            'ipAddress' => $ipAddress,
            'label' => $label,
            'billingAddress' => [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'emailAddress' => $emailAddress,
                'addressLine1' => $addressLine1,
                'addressLine2' => $addressLine2,
                'city' => $city,
                'state' => $state,
                'postalCode' => $postalCode,
                'country' => $country
            ],
            'creditCard' => [
                'expiration' => $expiration,
                'number' => $cardNumber,
                'verificationNumber' => $verificationNumber
            ]
        ];
        return parent::_requestData('post', 'creditCards', false, false, $data);
    }

    /**
     * Fund an Account
     *
     * @param string $customerIdentifier specify the customer associated with the credit card. Must be the customer the accountIdentifier is associated with.
     * @param string $accountIdentifier specify the account this credit card is associated with
     * @param string $creditCardToken specify the credit card token to fund with
     * @param string $amount specify the amount to fund in USD
     *
     * @return TangoCardResponse details of allocated fund
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function fundAccount(
        string $customerIdentifier,
        string $accountIdentifier,
        string $creditCardToken,
        string $amount
    ): TangoCardResponse {
        $data = [
            'accountIdentifier' => $accountIdentifier,
            'customerIdentifier' => $customerIdentifier,
            'creditCardToken' => $creditCardToken,
            'amount' => $amount
        ];
        return parent::_requestData('post', 'creditCardDeposits', false, false, $data);
    }

    /**
     * Unregister a Credit Card.
     *
     * @param string $customerIdentifier specify the customer associated with the credit card. Must be the customer the accountIdentifier is associated with.
     * @param string $accountIdentifier specify the account this credit card is associated with
     * @param string $creditCardToken specify the credit card token to fund with
     *
     * @return TangoCardResponse response
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function unregisterCreditCard(
        string $customerIdentifier,
        string $accountIdentifier,
        string $creditCardToken
    ): TangoCardResponse {
        $data = [
            'accountIdentifier' => $accountIdentifier,
            'customerIdentifier' => $customerIdentifier,
            'creditCardToken' => $creditCardToken
        ];
        return parent::_requestData('post', 'creditCardUnregisters', false, false, $data);
    }

    /**
     * Create an Order under a specific Account.
     *
     * @param $customerIdentifier
     * @param string $accountIdentifier specify the account this order will be deducted from
     * @param string $amount specify the face value of of the reward. Always required, including for fixed value items.
     * @param string $utid the unique identifier for the reward you are sending as provided in the Get Catalog call
     * @param string $sendEmail should Tango Card send the email to the recipient?
     * @param string $recipientEmail recipient Email:required if sendEmail is true
     * @param string $recipientFirstName recipient first name: required if sendEmail is true (100 character max)
     * @param null $recipientLastName recipient last name:always optional (100 character max)
     * @param null $campaign optional campaign that may be used to administratively categorize a specific order or, if applicable, call a designated campaign email template.
     * @param null $emailSubject Optional. If not specified, a default email subject will be used for the specified reward.
     * @param null $message optional gift message
     * @param null $notes Optional order notes (up to 150 characters)
     * @param null $senderEmail sender's Email:always optional
     * @param null $senderFirstName sender's first name: required if sendEmail is true (100 character max)
     * @param null $senderLastName sender's last name:always optional (100 character max)
     * @param null $externalRefID Optional. Idempotenent field that can be used for client-side order cross reference and prevent accidental order duplication. Will be returned in order response, order details, and order history.
     *
     *
     * @return TangoCardResponse created order response
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function placeOrder(
        $customerIdentifier,
        string $accountIdentifier,
        string $amount,
        string $utid,
        string $sendEmail,
        string $recipientEmail,
        $recipientFirstName,
        $recipientLastName = null,
        $campaign = null,
        $emailSubject = null,
        $message = null,
        $notes = null,
        $senderEmail = null,
        $senderFirstName = null,
        $senderLastName = null,
        $externalRefID = null
    ): TangoCardResponse {
        $data = [
            'accountIdentifier' => $accountIdentifier,
            'customerIdentifier' => $customerIdentifier,
            'amount' => $amount,
            'campaign' => $campaign,
            'emailSubject' => $emailSubject,
            'externalRefID' => $externalRefID,
            'message' => $message,
            'notes' => $notes,
            'utid' => $utid,
            'sendEmail' => $sendEmail,
            'recipient' => [
                'email' => $recipientEmail,
                'firstName' => $recipientFirstName,
                'lastName' => $recipientLastName
            ],
            'sender' => [
                'email' => $senderEmail,
                'firstName' => $senderFirstName,
                'lastName' => $senderLastName
            ]
        ];
        return parent::_requestData('post', 'orders', false, false, $data);
    }

    /**
     * Resend a specific Order
     *
     * @param string $referenceOrderID Reference order ID is returned in the order response payload
     *
     * @return TangoCardResponse response
     * @throws TangoCardRequestTypeInvalidException
     */
    final public function resendOrder(string $referenceOrderID): TangoCardResponse
    {
        return parent::_requestData('post', 'orders', $referenceOrderID, 'resends');
    }

}
