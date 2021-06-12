<?php

/**
 * Copyright 2021 Sage Intacct, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"). You may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "LICENSE" file accompanying this file. This file is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Intacct\Functions\AccountsReceivable;

use Intacct\Functions\AbstractFunction;
use Intacct\Functions\Traits\CustomFieldsTrait;
use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

abstract class AbstractCustomer extends AbstractFunction
{

    /** @var string */
    const RESTRICTION_TYPE_UNRESTRICTED = 'Unrestricted';

    /** @var string */
    const RESTRICTION_TYPE_TOPLEVEL = 'RootOnly';

    /** @var string */
    const RESTRICTION_TYPE_RESTRICTED = 'Restricted';

    use CustomFieldsTrait;

    /** @var int */
    protected $recordNo;

    /** @var string */
    protected $customerId;

    /** @var string */
    protected $customerName;

    /** @var bool */
    protected $oneTime;

    /** @var bool */
    protected $active;

    /** @var string */
    protected $lastName;

    /** @var string */
    protected $firstName;

    /** @var string */
    protected $middleName;

    /** @var string */
    protected $prefix;

    /** @var string */
    protected $companyName;

    /** @var string */
    protected $printAs;

    /** @var string */
    protected $primaryPhoneNo;

    /** @var string */
    protected $secondaryPhoneNo;

    /** @var string */
    protected $cellularPhoneNo;

    /** @var string */
    protected $pagerNo;

    /** @var string */
    protected $faxNo;

    /** @var string */
    protected $primaryEmailAddress;

    /** @var string */
    protected $secondaryEmailAddress;

    /** @var string */
    protected $primaryUrl;

    /** @var string */
    protected $secondaryUrl;

    /** @var string */
    protected $addressLine1;

    /** @var string */
    protected $addressLine2;

    /** @var string */
    protected $city;

    /** @var string */
    protected $stateProvince;

    /** @var string */
    protected $zipPostalCode;

    /** @var string */
    protected $country;

    /** @var string */
    protected $isoCountryCode;

    /** @var bool */
    protected $excludedFromContactList;

    /** @var string */
    protected $customerTypeId;

    /** @var string */
    protected $salesRepEmployeeId;

    /** @var string */
    protected $parentCustomerId;

    /** @var string */
    protected $glGroupName;

    /** @var string */
    protected $territoryId;

    /** @var string */
    protected $attachmentsId;

    /** @var string */
    protected $paymentTerm;

    /** @var string */
    protected $offsetArGlAccountNo;

    /** @var string */
    protected $defaultRevenueGlAccountNo;

    /** @var string */
    protected $shippingMethod;

    /** @var string */
    protected $resaleNumber;

    /** @var bool */
    protected $taxable;

    /** @var string */
    protected $contactTaxGroupName;

    /** @var string */
    protected $taxId;

    /** @var float */
    protected $creditLimit;

    /** @var bool */
    protected $onHold;

    /** @var string|string[] */
    protected $deliveryMethod;

    /** @var string */
    protected $defaultInvoiceMessage;

    /** @var string */
    protected $comments;

    /** @var string */
    protected $defaultCurrency;

    /** @var string */
    protected $printOptionArInvoiceTemplateName;

    /** @var string */
    protected $printOptionOeQuoteTemplateName;

    /** @var string */
    protected $printOptionOeOrderTemplateName;

    /** @var string */
    protected $printOptionOeListTemplateName;

    /** @var string */
    protected $printOptionOeInvoiceTemplateName;

    /** @var string */
    protected $printOptionOeAdjustmentTemplateName;

    /** @var string */
    protected $printOptionOeOtherTemplateName;

    // TODO: Email template options

    /** @var string */
    protected $primaryContactName;

    /** @var string */
    protected $billToContactName;

    /** @var string */
    protected $shipToContactName;

    // TODO contact list

    /** @var string */
    protected $restrictionType;

    /** @var array */
    protected $restrictedLocations = [];

    /** @var array */
    protected $restrictedDepartments = [];

    /**
     * Get record number
     *
     * @return int|string
     */
    public function getRecordNo()
    {
        return $this->recordNo;
    }

    /**
     * Set record number
     *
     * @param int|string $recordNo
     */
    public function setRecordNo($recordNo)
    {
        $this->recordNo = $recordNo;
    }

    /**
     * Get customer ID
     *
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set customer ID
     *
     * @param string $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * Get customer name
     *
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set customer name
     *
     * @param string $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * Get one time
     *
     * @return bool
     */
    public function isOneTime()
    {
        return $this->oneTime;
    }

    /**
     * Set one time
     *
     * @param bool $oneTime
     */
    public function setOneTime($oneTime)
    {
        $this->oneTime = $oneTime;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set active
     *
     * @param bool $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Get last name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set last name
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get first name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set first name
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get middle name
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set middle name
     *
     * @param string $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Get company name
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set company name
     *
     * @param string $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * Get print as
     *
     * @return string
     */
    public function getPrintAs()
    {
        return $this->printAs;
    }

    /**
     * Set print as
     *
     * @param string $printAs
     */
    public function setPrintAs($printAs)
    {
        $this->printAs = $printAs;
    }

    /**
     * Get primary phone number
     *
     * @return string
     */
    public function getPrimaryPhoneNo()
    {
        return $this->primaryPhoneNo;
    }

    /**
     * Set primary phone number
     *
     * @param string $primaryPhoneNo
     */
    public function setPrimaryPhoneNo($primaryPhoneNo)
    {
        $this->primaryPhoneNo = $primaryPhoneNo;
    }

    /**
     * Get secondary phone number
     *
     * @return string
     */
    public function getSecondaryPhoneNo()
    {
        return $this->secondaryPhoneNo;
    }

    /**
     * Set secondary phone number
     *
     * @param string $secondaryPhoneNo
     */
    public function setSecondaryPhoneNo($secondaryPhoneNo)
    {
        $this->secondaryPhoneNo = $secondaryPhoneNo;
    }

    /**
     * Get cellular phone number
     *
     * @return string
     */
    public function getCellularPhoneNo()
    {
        return $this->cellularPhoneNo;
    }

    /**
     * Set cellular phone number
     *
     * @param string $cellularPhoneNo
     */
    public function setCellularPhoneNo($cellularPhoneNo)
    {
        $this->cellularPhoneNo = $cellularPhoneNo;
    }

    /**
     * Get pager number
     *
     * @return string
     */
    public function getPagerNo()
    {
        return $this->pagerNo;
    }

    /**
     * Set pager number
     *
     * @param string $pagerNo
     */
    public function setPagerNo($pagerNo)
    {
        $this->pagerNo = $pagerNo;
    }

    /**
     * Get fax number
     *
     * @return string
     */
    public function getFaxNo()
    {
        return $this->faxNo;
    }

    /**
     * Set fax number
     *
     * @param string $faxNo
     */
    public function setFaxNo($faxNo)
    {
        $this->faxNo = $faxNo;
    }

    /**
     * Get primary email address
     *
     * @return string
     */
    public function getPrimaryEmailAddress()
    {
        return $this->primaryEmailAddress;
    }

    /**
     * Set primary email address
     *
     * @param string $primaryEmailAddress
     */
    public function setPrimaryEmailAddress($primaryEmailAddress)
    {
        if ($primaryEmailAddress !== '' && filter_var($primaryEmailAddress, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Primary Email Address is not a valid email');
        }
        $this->primaryEmailAddress = $primaryEmailAddress;
    }

    /**
     * Get secondary email address
     *
     * @return string
     */
    public function getSecondaryEmailAddress()
    {
        return $this->secondaryEmailAddress;
    }

    /**
     * Set secondary email address
     *
     * @param string $secondaryEmailAddress
     */
    public function setSecondaryEmailAddress($secondaryEmailAddress)
    {
        if ($secondaryEmailAddress !== '' && filter_var($secondaryEmailAddress, FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidArgumentException('Secondary Email Address is not a valid email');
        }
        $this->secondaryEmailAddress = $secondaryEmailAddress;
    }

    /**
     * Get primary URL
     *
     * @return string
     */
    public function getPrimaryUrl()
    {
        return $this->primaryUrl;
    }

    /**
     * Set primary URL
     *
     * @param string $primaryUrl
     */
    public function setPrimaryUrl($primaryUrl)
    {
        $this->primaryUrl = $primaryUrl;
    }

    /**
     * Get secondary URL
     *
     * @return string
     */
    public function getSecondaryUrl()
    {
        return $this->secondaryUrl;
    }

    /**
     * Set secondary URL
     *
     * @param string $secondaryUrl
     */
    public function setSecondaryUrl($secondaryUrl)
    {
        $this->secondaryUrl = $secondaryUrl;
    }

    /**
     * Get address line 1
     *
     * @return string
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * Set address line 1
     *
     * @param string $addressLine1
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;
    }

    /**
     * Get address line 2
     *
     * @return string
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * Set address line 2
     *
     * @param string $addressLine2
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get state/province
     *
     * @return string
     */
    public function getStateProvince()
    {
        return $this->stateProvince;
    }

    /**
     * Set state/province
     *
     * @param string $stateProvince
     */
    public function setStateProvince($stateProvince)
    {
        $this->stateProvince = $stateProvince;
    }

    /**
     * Get zip/postal code
     *
     * @return string
     */
    public function getZipPostalCode()
    {
        return $this->zipPostalCode;
    }

    /**
     * Set zip/postal code
     *
     * @param string $zipPostalCode
     */
    public function setZipPostalCode($zipPostalCode)
    {
        $this->zipPostalCode = $zipPostalCode;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getIsoCountryCode()
    {
        return $this->isoCountryCode;
    }

    /**
     * @param string $isoCountryCode
     */
    public function setIsoCountryCode($isoCountryCode)
    {
        $this->isoCountryCode = $isoCountryCode;
    }

    /**
     * Get excluded from contact list
     *
     * @return bool
     */
    public function isExcludedFromContactList()
    {
        return $this->excludedFromContactList;
    }

    /**
     * Set excluded from contact list
     *
     * @param bool $excludedFromContactList
     */
    public function setExcludedFromContactList($excludedFromContactList)
    {
        $this->excludedFromContactList = $excludedFromContactList;
    }

    /**
     * Get customer type ID
     *
     * @return string
     */
    public function getCustomerTypeId()
    {
        return $this->customerTypeId;
    }

    /**
     * Set customer type ID
     *
     * @param string $customerTypeId
     */
    public function setCustomerTypeId($customerTypeId)
    {
        $this->customerTypeId = $customerTypeId;
    }

    /**
     * Get sales representative employee ID
     *
     * @return string
     */
    public function getSalesRepEmployeeId()
    {
        return $this->salesRepEmployeeId;
    }

    /**
     * Set sales representative employee ID
     *
     * @param string $salesRepEmployeeId
     */
    public function setSalesRepEmployeeId($salesRepEmployeeId)
    {
        $this->salesRepEmployeeId = $salesRepEmployeeId;
    }

    /**
     * Get parent customer ID
     *
     * @return string
     */
    public function getParentCustomerId()
    {
        return $this->parentCustomerId;
    }

    /**
     * Set parent customer ID
     *
     * @param string $parentCustomerId
     */
    public function setParentCustomerId($parentCustomerId)
    {
        $this->parentCustomerId = $parentCustomerId;
    }

    /**
     * Get GL group name
     *
     * @return string
     */
    public function getGlGroupName()
    {
        return $this->glGroupName;
    }

    /**
     * Set GL group name
     *
     * @param string $glGroupName
     */
    public function setGlGroupName($glGroupName)
    {
        $this->glGroupName = $glGroupName;
    }

    /**
     * Get territory ID
     *
     * @return string
     */
    public function getTerritoryId()
    {
        return $this->territoryId;
    }

    /**
     * Set territory ID
     *
     * @param string $territoryId
     */
    public function setTerritoryId($territoryId)
    {
        $this->territoryId = $territoryId;
    }

    /**
     * Get attachments ID
     *
     * @return string
     */
    public function getAttachmentsId()
    {
        return $this->attachmentsId;
    }

    /**
     * Set attachments ID
     *
     * @param string $attachmentsId
     */
    public function setAttachmentsId($attachmentsId)
    {
        $this->attachmentsId = $attachmentsId;
    }

    /**
     * Get payment term
     *
     * @return string
     */
    public function getPaymentTerm()
    {
        return $this->paymentTerm;
    }

    /**
     * Set payment term
     *
     * @param string $paymentTerm
     */
    public function setPaymentTerm($paymentTerm)
    {
        $this->paymentTerm = $paymentTerm;
    }

    /**
     * Get offset AR GL account number
     *
     * @return string
     */
    public function getOffsetArGlAccountNo()
    {
        return $this->offsetArGlAccountNo;
    }

    /**
     * Set offset AR GL account number
     *
     * @param string $offsetArGlAccountNo
     */
    public function setOffsetArGlAccountNo($offsetArGlAccountNo)
    {
        $this->offsetArGlAccountNo = $offsetArGlAccountNo;
    }

    /**
     * Get default revenue GL account number
     * @return string
     */
    public function getDefaultRevenueGlAccountNo()
    {
        return $this->defaultRevenueGlAccountNo;
    }

    /**
     * Set default revenue GL account number
     *
     * @param string $defaultRevenueGlAccountNo
     */
    public function setDefaultRevenueGlAccountNo($defaultRevenueGlAccountNo)
    {
        $this->defaultRevenueGlAccountNo = $defaultRevenueGlAccountNo;
    }

    /**
     * Get shipping method
     *
     * @return string
     */
    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    /**
     * Set shipping method
     *
     * @param string $shippingMethod
     */
    public function setShippingMethod($shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
    }

    /**
     * Get resale number
     *
     * @return string
     */
    public function getResaleNumber()
    {
        return $this->resaleNumber;
    }

    /**
     * Set resale number
     *
     * @param string $resaleNumber
     */
    public function setResaleNumber($resaleNumber)
    {
        $this->resaleNumber = $resaleNumber;
    }

    /**
     * Get taxable
     *
     * @return bool
     */
    public function isTaxable()
    {
        return $this->taxable;
    }

    /**
     * Set taxable
     *
     * @param bool $taxable
     */
    public function setTaxable($taxable)
    {
        $this->taxable = $taxable;
    }

    /**
     * Get contact tax group name
     *
     * @return string
     */
    public function getContactTaxGroupName()
    {
        return $this->contactTaxGroupName;
    }

    /**
     * Set contact tax group name
     *
     * @param string $contactTaxGroupName
     */
    public function setContactTaxGroupName($contactTaxGroupName)
    {
        $this->contactTaxGroupName = $contactTaxGroupName;
    }

    /**
     * Get tax ID
     *
     * @return string
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * Set tax ID
     *
     * @param string $taxId
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;
    }

    /**
     * Get on hold
     *
     * @return bool
     */
    public function isOnHold()
    {
        return $this->onHold;
    }

    /**
     * Set on hold
     *
     * @param bool $onHold
     */
    public function setOnHold($onHold)
    {
        $this->onHold = $onHold;
    }

    /**
     * Get credit limit
     *
     * @return float|int|string
     */
    public function getCreditLimit()
    {
        return $this->creditLimit;
    }

    /**
     * Set credit limit
     *
     * @param float|int|string $creditLimit
     */
    public function setCreditLimit($creditLimit)
    {
        $this->creditLimit = $creditLimit;
    }

    /**
     * Get delivery method
     *
     * @return string|string[]
     */
    public function getDeliveryMethod()
    {
        return $this->deliveryMethod;
    }

    /**
     * Set delivery method
     *
     * @param string|string[] $deliveryMethod
     */
    public function setDeliveryMethod($deliveryMethod)
    {
        $this->deliveryMethod = $deliveryMethod;
    }

    /**
     * Get default invoice message
     *
     * @return string
     */
    public function getDefaultInvoiceMessage()
    {
        return $this->defaultInvoiceMessage;
    }

    /**
     * Set default invoice message
     *
     * @param string $defaultInvoiceMessage
     */
    public function setDefaultInvoiceMessage($defaultInvoiceMessage)
    {
        $this->defaultInvoiceMessage = $defaultInvoiceMessage;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set comments
     *
     * @param string $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * Get default currency
     *
     * @return string
     */
    public function getDefaultCurrency()
    {
        return $this->defaultCurrency;
    }

    /**
     * Set default currency
     *
     * @param string $defaultCurrency
     */
    public function setDefaultCurrency($defaultCurrency)
    {
        $this->defaultCurrency = $defaultCurrency;
    }

    /**
     * Get print option AR invoice template name
     *
     * @return string
     */
    public function getPrintOptionArInvoiceTemplateName()
    {
        return $this->printOptionArInvoiceTemplateName;
    }

    /**
     * Set print option AR invoice template name
     *
     * @param string $printOptionArInvoiceTemplateName
     */
    public function setPrintOptionArInvoiceTemplateName(
        $printOptionArInvoiceTemplateName
    ) {
        $this->printOptionArInvoiceTemplateName
            = $printOptionArInvoiceTemplateName;
    }

    /**
     * Get print option OE quote template name
     *
     * @return string
     */
    public function getPrintOptionOeQuoteTemplateName()
    {
        return $this->printOptionOeQuoteTemplateName;
    }

    /**
     * Set print option OE quote template name
     *
     * @param string $printOptionOeQuoteTemplateName
     */
    public function setPrintOptionOeQuoteTemplateName(
        $printOptionOeQuoteTemplateName
    ) {
        $this->printOptionOeQuoteTemplateName = $printOptionOeQuoteTemplateName;
    }

    /**
     * Get print option OE order template name
     *
     * @return string
     */
    public function getPrintOptionOeOrderTemplateName()
    {
        return $this->printOptionOeOrderTemplateName;
    }

    /**
     * Set print option OE order template name
     *
     * @param string $printOptionOeOrderTemplateName
     */
    public function setPrintOptionOeOrderTemplateName(
        $printOptionOeOrderTemplateName
    ) {
        $this->printOptionOeOrderTemplateName = $printOptionOeOrderTemplateName;
    }

    /**
     * Get print option OE list template name
     *
     * @return string
     */
    public function getPrintOptionOeListTemplateName()
    {
        return $this->printOptionOeListTemplateName;
    }

    /**
     * Set print option OE list template name
     *
     * @param string $printOptionOeListTemplateName
     */
    public function setPrintOptionOeListTemplateName(
        $printOptionOeListTemplateName
    ) {
        $this->printOptionOeListTemplateName = $printOptionOeListTemplateName;
    }

    /**
     * Get print option OE invoice template name
     *
     * @return string
     */
    public function getPrintOptionOeInvoiceTemplateName()
    {
        return $this->printOptionOeInvoiceTemplateName;
    }

    /**
     * Set print option OE invoice template name
     *
     * @param string $printOptionOeInvoiceTemplateName
     */
    public function setPrintOptionOeInvoiceTemplateName(
        $printOptionOeInvoiceTemplateName
    ) {
        $this->printOptionOeInvoiceTemplateName
            = $printOptionOeInvoiceTemplateName;
    }

    /**
     * Get print option OE adjustment template name
     *
     * @return string
     */
    public function getPrintOptionOeAdjustmentTemplateName()
    {
        return $this->printOptionOeAdjustmentTemplateName;
    }

    /**
     * Set print option OE adjustment template name
     *
     * @param string $printOptionOeAdjustmentTemplateName
     */
    public function setPrintOptionOeAdjustmentTemplateName(
        $printOptionOeAdjustmentTemplateName
    ) {
        $this->printOptionOeAdjustmentTemplateName = $printOptionOeAdjustmentTemplateName;
    }

    /**
     * Get print option OE other template name
     *
     * @return string
     */
    public function getPrintOptionOeOtherTemplateName()
    {
        return $this->printOptionOeOtherTemplateName;
    }

    /**
     * Set print option OE other template name
     *
     * @param string $printOptionOeOtherTemplateName
     */
    public function setPrintOptionOeOtherTemplateName(
        $printOptionOeOtherTemplateName
    ) {
        $this->printOptionOeOtherTemplateName = $printOptionOeOtherTemplateName;
    }

    /**
     * Get primary contact name
     *
     * @return string
     */
    public function getPrimaryContactName()
    {
        return $this->primaryContactName;
    }

    /**
     * Set primary contact name
     *
     * @param string $primaryContactName
     */
    public function setPrimaryContactName($primaryContactName)
    {
        $this->primaryContactName = $primaryContactName;
    }

    /**
     * Get bill to contact name
     *
     * @return string
     */
    public function getBillToContactName()
    {
        return $this->billToContactName;
    }

    /**
     * Set bill to contact name
     *
     * @param string $billToContactName
     */
    public function setBillToContactName($billToContactName)
    {
        $this->billToContactName = $billToContactName;
    }

    /**
     * Get ship to contact name
     *
     * @return string
     */
    public function getShipToContactName()
    {
        return $this->shipToContactName;
    }

    /**
     * Set ship to contact name
     *
     * @param string $shipToContactName
     */
    public function setShipToContactName($shipToContactName)
    {
        $this->shipToContactName = $shipToContactName;
    }

    /**
     * Get restriction type
     *
     * @return string
     */
    public function getRestrictionType()
    {
        return $this->restrictionType;
    }

    /**
     * Set restriction type
     *
     * @param string $restrictionType
     */
    public function setRestrictionType($restrictionType)
    {
        $restrictionTypes = [
            static::RESTRICTION_TYPE_UNRESTRICTED,
            static::RESTRICTION_TYPE_RESTRICTED,
            static::RESTRICTION_TYPE_TOPLEVEL,
        ];
        if (!in_array($restrictionType, $restrictionTypes)) {
            throw new InvalidArgumentException('Restriction Type is not valid');
        }
        $this->restrictionType = $restrictionType;
    }

    /**
     * Get restricted locations
     *
     * @return array
     */
    public function getRestrictedLocations()
    {
        return $this->restrictedLocations;
    }

    /**
     * Set restricted locations
     *
     * @param array $restrictedLocations
     */
    public function setRestrictedLocations($restrictedLocations)
    {
        $this->restrictedLocations = $restrictedLocations;
    }

    /**
     * Get restricted departments
     *
     * @return array
     */
    public function getRestrictedDepartments()
    {
        return $this->restrictedDepartments;
    }

    /**
     * Set restricted departments
     *
     * @param array $restrictedDepartments
     */
    public function setRestrictedDepartments($restrictedDepartments)
    {
        $this->restrictedDepartments = $restrictedDepartments;
    }

    /**
     * @param XMLWriter $xml
     */
    public function writeXmlMailAddress(XMLWriter &$xml)
    {
        if ($this->getAddressLine1()
            || $this->getAddressLine2()
            || $this->getCity()
            || $this->getStateProvince()
            || $this->getZipPostalCode()
            || $this->getCountry()
            || $this->getIsoCountryCode()) {
            $xml->startElement('MAILADDRESS');

            $xml->writeElement('ADDRESS1', $this->getAddressLine1());
            $xml->writeElement('ADDRESS2', $this->getAddressLine2());
            $xml->writeElement('CITY', $this->getCity());
            $xml->writeElement('STATE', $this->getStateProvince());
            $xml->writeElement('ZIP', $this->getZipPostalCode());
            $xml->writeElement('COUNTRY', $this->getCountry());
            $xml->writeElement('COUNTRYCODE', $this->getIsoCountryCode());

            $xml->endElement(); //MAILADDRESS
        }
    }
}
