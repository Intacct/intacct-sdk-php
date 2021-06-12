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

namespace Intacct\Functions\AccountsPayable;

use Intacct\Functions\AbstractFunction;
use Intacct\Functions\Traits\CustomFieldsTrait;
use Intacct\Xml\XMLWriter;

abstract class AbstractVendor extends AbstractFunction
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
    protected $vendorId;

    /** @var string */
    protected $vendorName;

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
    protected $vendorTypeId;

    /** @var string */
    protected $parentVendorId;

    /** @var string */
    protected $glGroupName;

    /** @var string */
    protected $taxId;

    /** @var string */
    protected $form1099Name;

    /** @var string */
    protected $form1099Type;

    /** @var int|string */
    protected $form1099Box;

    /** @var string */
    protected $attachmentsId;

    /** @var string */
    protected $defaultExpenseGlAccountNo;

    /** @var bool */
    protected $taxable;

    /** @var string */
    protected $contactTaxGroupName;

    /** @var float */
    protected $creditLimit;

    /** @var bool */
    protected $onHold;

    /** @var bool */
    protected $doNotPay;

    /** @var string */
    protected $comments;

    /** @var string */
    protected $defaultCurrency;

    /** @var string */
    protected $primaryContactName;

    /** @var string */
    protected $payToContactName;

    /** @var string */
    protected $returnToContactName;

    // TODO contact list

    /** @var string */
    protected $preferredPaymentMethod;

    /** @var bool */
    protected $sendAutomaticPaymentNotification;

    /** @var bool */
    protected $mergePaymentRequests;

    /** @var string */
    protected $vendorBillingType;

    // TODO default bill payment date

    /** @var string */
    protected $paymentPriority;

    /** @var string */
    protected $paymentTerm;

    /** @var bool */
    protected $termDiscountDisplayedOnCheckStub;

    /** @var bool */
    protected $achEnabled;

    /** @var string */
    protected $achBankRoutingNo;

    /** @var string */
    protected $achBankAccountNo;

    /** @var string */
    protected $achBankAccountType;

    /** @var string */
    protected $achBankAccountClass;

    // TODO check delivery and ACH payment services

    /** @var string */
    protected $vendorAccountNo;

    /** @var bool */
    protected $locationAssignedAccountNoDisplayedOnCheckStub;

    // TODO location assigned vendor account no's

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
     * Get vendor ID
     *
     * @return string
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * Set vendor ID
     *
     * @param string $vendorId
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * Get vendor name
     *
     * @return string
     */
    public function getVendorName()
    {
        return $this->vendorName;
    }

    /**
     * Set vendor name
     *
     * @param string $vendorName
     */
    public function setVendorName($vendorName)
    {
        $this->vendorName = $vendorName;
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
        if (!empty($primaryEmailAddress) && filter_var($primaryEmailAddress, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Primary Email Address is not a valid email');
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
        if (filter_var($secondaryEmailAddress, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Secondary Email Address is not a valid email');
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
     * Get vendor type ID
     *
     * @return string
     */
    public function getVendorTypeId()
    {
        return $this->vendorTypeId;
    }

    /**
     * Set vendor type ID
     *
     * @param string $vendorTypeId
     */
    public function setVendorTypeId($vendorTypeId)
    {
        $this->vendorTypeId = $vendorTypeId;
    }

    /**
     * Get parent vendor ID
     *
     * @return string
     */
    public function getParentVendorId()
    {
        return $this->parentVendorId;
    }

    /**
     * Set parent vendor ID
     *
     * @param string $parentVendorId
     */
    public function setParentVendorId($parentVendorId)
    {
        $this->parentVendorId = $parentVendorId;
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
     * Get form 1099 name
     *
     * @return string
     */
    public function getForm1099Name()
    {
        return $this->form1099Name;
    }

    /**
     * Set form 1099 name
     *
     * @param string $form1099Name
     */
    public function setForm1099Name($form1099Name)
    {
        $this->form1099Name = $form1099Name;
    }

    /**
     * Get form 1099 type
     *
     * @return string
     */
    public function getForm1099Type()
    {
        return $this->form1099Type;
    }

    /**
     * Set form 1099 type
     *
     * @param string $form1099Type
     */
    public function setForm1099Type($form1099Type)
    {
        $this->form1099Type = $form1099Type;
    }

    /**
     * Get form 1099 box
     *
     * @return int|string
     */
    public function getForm1099Box()
    {
        return $this->form1099Box;
    }

    /**
     * Set form 1099 box
     *
     * @param int|string $form1099Box
     */
    public function setForm1099Box($form1099Box)
    {
        $this->form1099Box = $form1099Box;
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
     * Get default expense GL account number
     *
     * @return string
     */
    public function getDefaultExpenseGlAccountNo()
    {
        return $this->defaultExpenseGlAccountNo;
    }

    /**
     * Set default expense GL account number
     *
     * @param string $defaultExpenseGlAccountNo
     */
    public function setDefaultExpenseGlAccountNo($defaultExpenseGlAccountNo)
    {
        $this->defaultExpenseGlAccountNo = $defaultExpenseGlAccountNo;
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
     * Get do not pay
     *
     * @return bool
     */
    public function isDoNotPay()
    {
        return $this->doNotPay;
    }

    /**
     * Set do not pay
     *
     * @param bool $doNotPay
     */
    public function setDoNotPay($doNotPay)
    {
        $this->doNotPay = $doNotPay;
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
     * Get pay to contact name
     *
     * @return string
     */
    public function getPayToContactName()
    {
        return $this->payToContactName;
    }

    /**
     * Set pay to contact name
     *
     * @param string $payToContactName
     */
    public function setPayToContactName($payToContactName)
    {
        $this->payToContactName = $payToContactName;
    }

    /**
     * Get return to contact name
     *
     * @return string
     */
    public function getReturnToContactName()
    {
        return $this->returnToContactName;
    }

    /**
     * Set return to contact name
     *
     * @param string $returnToContactName
     */
    public function setReturnToContactName($returnToContactName)
    {
        $this->returnToContactName = $returnToContactName;
    }

    /**
     * Get preferred payment method
     *
     * @return string
     */
    public function getPreferredPaymentMethod()
    {
        return $this->preferredPaymentMethod;
    }

    /**
     * Set preferred payment method
     *
     * @param string $preferredPaymentMethod
     */
    public function setPreferredPaymentMethod($preferredPaymentMethod)
    {
        $this->preferredPaymentMethod = $preferredPaymentMethod;
    }

    /**
     * Get send automatic payment notification
     *
     * @return bool
     */
    public function isSendAutomaticPaymentNotification()
    {
        return $this->sendAutomaticPaymentNotification;
    }

    /**
     * Set send automatic payment notification
     *
     * @param bool $sendAutomaticPaymentNotification
     */
    public function setSendAutomaticPaymentNotification($sendAutomaticPaymentNotification)
    {
        $this->sendAutomaticPaymentNotification = $sendAutomaticPaymentNotification;
    }

    /**
     * Get merge payment requests
     *
     * @return bool
     */
    public function isMergePaymentRequests()
    {
        return $this->mergePaymentRequests;
    }

    /**
     * Set merge payment requests
     *
     * @param bool $mergePaymentRequests
     */
    public function setMergePaymentRequests($mergePaymentRequests)
    {
        $this->mergePaymentRequests = $mergePaymentRequests;
    }

    /**
     * Get vendor billing type
     *
     * @return string
     */
    public function getVendorBillingType()
    {
        return $this->vendorBillingType;
    }

    /**
     * Set vendor billing type
     *
     * @param string $vendorBillingType
     */
    public function setVendorBillingType($vendorBillingType)
    {
        $this->vendorBillingType = $vendorBillingType;
    }

    /**
     * Get payment priority
     *
     * @return string
     */
    public function getPaymentPriority()
    {
        return $this->paymentPriority;
    }

    /**
     * Set payment priority
     *
     * @param string $paymentPriority
     */
    public function setPaymentPriority($paymentPriority)
    {
        $this->paymentPriority = $paymentPriority;
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
     * Get term discount displayed on check stub
     *
     * @return bool
     */
    public function isTermDiscountDisplayedOnCheckStub()
    {
        return $this->termDiscountDisplayedOnCheckStub;
    }

    /**
     * Set term discount displayed on check stub
     *
     * @param bool $termDiscountDisplayedOnCheckStub
     */
    public function setTermDiscountDisplayedOnCheckStub($termDiscountDisplayedOnCheckStub)
    {
        $this->termDiscountDisplayedOnCheckStub = $termDiscountDisplayedOnCheckStub;
    }

    /**
     * Get ACH enabled
     *
     * @return bool
     */
    public function isAchEnabled()
    {
        return $this->achEnabled;
    }

    /**
     * Set ACH enabled
     *
     * @param bool $achEnabled
     */
    public function setAchEnabled($achEnabled)
    {
        $this->achEnabled = $achEnabled;
    }

    /**
     * Get ACH bank routing number
     *
     * @return string
     */
    public function getAchBankRoutingNo()
    {
        return $this->achBankRoutingNo;
    }

    /**
     * Set ACH bank routing number
     *
     * @param string $achBankRoutingNo
     */
    public function setAchBankRoutingNo($achBankRoutingNo)
    {
        $this->achBankRoutingNo = $achBankRoutingNo;
    }

    /**
     * Get ACH bank account number
     *
     * @return string
     */
    public function getAchBankAccountNo()
    {
        return $this->achBankAccountNo;
    }

    /**
     * Set ACH bank account number
     *
     * @param string $achBankAccountNo
     */
    public function setAchBankAccountNo($achBankAccountNo)
    {
        $this->achBankAccountNo = $achBankAccountNo;
    }

    /**
     * Get ACH bank account type
     *
     * @return string
     */
    public function getAchBankAccountType()
    {
        return $this->achBankAccountType;
    }

    /**
     * Set ACH bank account type
     *
     * @param string $achBankAccountType
     */
    public function setAchBankAccountType($achBankAccountType)
    {
        $this->achBankAccountType = $achBankAccountType;
    }

    /**
     * Get ACH bank account class
     *
     * @return string
     */
    public function getAchBankAccountClass()
    {
        return $this->achBankAccountClass;
    }

    /**
     * Set ACH bank account class
     *
     * @param string $achBankAccountClass
     */
    public function setAchBankAccountClass($achBankAccountClass)
    {
        $this->achBankAccountClass = $achBankAccountClass;
    }

    /**
     * Get vendor account number
     *
     * @return string
     */
    public function getVendorAccountNo()
    {
        return $this->vendorAccountNo;
    }

    /**
     * Set vendor account number
     *
     * @param string $vendorAccountNo
     */
    public function setVendorAccountNo($vendorAccountNo)
    {
        $this->vendorAccountNo = $vendorAccountNo;
    }

    /**
     * Get location assigned account numbers displayed on check stub
     *
     * @return bool
     */
    public function isLocationAssignedAccountNoDisplayedOnCheckStub()
    {
        return $this->locationAssignedAccountNoDisplayedOnCheckStub;
    }

    /**
     * Set location assigned account numbers displayed on check stub
     *
     * @param bool $locationAssignedAccountNoDisplayedOnCheckStub
     */
    public function setLocationAssignedAccountNoDisplayedOnCheckStub($locationAssignedAccountNoDisplayedOnCheckStub)
    {
        $this->locationAssignedAccountNoDisplayedOnCheckStub = $locationAssignedAccountNoDisplayedOnCheckStub;
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
            throw new \InvalidArgumentException('Restriction Type is not valid');
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
