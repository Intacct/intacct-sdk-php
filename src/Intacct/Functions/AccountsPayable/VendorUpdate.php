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

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * Update an existing vendor record
 */
class VendorUpdate extends AbstractVendor
{

    /**
     * Write the function block XML
     *
     * @param XMLWriter $xml
     * @throw InvalidArgumentException
     */
    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->getControlId());

        $xml->startElement('update');
        $xml->startElement('VENDOR');

        /* According to the docs, either Vendor ID or record number are allowable. Previously, the library required Vendor ID. Change to support both. */
        if ($this->getVendorId()) {
            $xml->writeElement('VENDORID', $this->getVendorId(), true);
        }
		else if ($this->getRecordNo()) {
            $xml->writeElement('RECORDNO', $this->getRecordNo(), true);
        }
        else {
            throw new InvalidArgumentException('Vendor ID or record number is required for update');
        }
            
        $xml->writeElement('NAME', $this->getVendorName());

        $xml->startElement('DISPLAYCONTACT');

        $xml->writeElement('PRINTAS', $this->getPrintAs());
        $xml->writeElement('COMPANYNAME', $this->getCompanyName());
        $xml->writeElement('TAXABLE', $this->isTaxable());
        // TAXID is passed in with VENDOR element below
        $xml->writeElement('TAXGROUP', $this->getContactTaxGroupName());
        $xml->writeElement('PREFIX', $this->getPrefix());
        $xml->writeElement('FIRSTNAME', $this->getFirstName());
        $xml->writeElement('LASTNAME', $this->getLastName());
        $xml->writeElement('INITIAL', $this->getMiddleName());
        $xml->writeElement('PHONE1', $this->getPrimaryPhoneNo());
        $xml->writeElement('PHONE2', $this->getSecondaryPhoneNo());
        $xml->writeElement('CELLPHONE', $this->getCellularPhoneNo());
        $xml->writeElement('PAGER', $this->getPagerNo());
        $xml->writeElement('FAX', $this->getFaxNo());
        $xml->writeElement('EMAIL1', $this->getPrimaryEmailAddress());
        $xml->writeElement('EMAIL2', $this->getSecondaryEmailAddress());
        $xml->writeElement('URL1', $this->getPrimaryUrl());
        $xml->writeElement('URL2', $this->getSecondaryUrl());

        $this->writeXmlMailAddress($xml);

        $xml->endElement(); //DISPLAYCONTACT

        $xml->writeElement('ONETIME', $this->isOneTime());

        if ($this->isActive() === true) {
            $xml->writeElement('STATUS', 'active');
        } elseif ($this->isActive() === false) {
            $xml->writeElement('STATUS', 'inactive');
        }

        $xml->writeElement('HIDEDISPLAYCONTACT', $this->isExcludedFromContactList());
        $xml->writeElement('VENDTYPE', $this->getVendorTypeId());
        $xml->writeElement('PARENTID', $this->getParentVendorId());
        $xml->writeElement('GLGROUP', $this->getGlGroupName());
        $xml->writeElement('TAXID', $this->getTaxId());
        $xml->writeElement('NAME1099', $this->getForm1099Name());
        $xml->writeElement('FORM1099TYPE', $this->getForm1099Type());
        $xml->writeElement('FORM1099BOX', $this->getForm1099Box());
        $xml->writeElement('SUPDOCID', $this->getAttachmentsId());
        $xml->writeElement('APACCOUNT', $this->getDefaultExpenseGlAccountNo());
        $xml->writeElement('CREDITLIMIT', $this->getCreditLimit());
        $xml->writeElement('ONHOLD', $this->isOnHold());
        $xml->writeElement('DONOTCUTCHECK', $this->isDoNotPay());
        $xml->writeElement('COMMENTS', $this->getComments());
        $xml->writeElement('CURRENCY', $this->getDefaultCurrency());

        if ($this->getPrimaryContactName() !== null) {
            $xml->startElement('CONTACTINFO');
            $xml->writeElement('CONTACTNAME', $this->getPrimaryContactName(), true);
            $xml->endElement(); //CONTACTINFO
        }

        if ($this->getPayToContactName() !== null) {
            $xml->startElement('PAYTO');
            $xml->writeElement('CONTACTNAME', $this->getPayToContactName(), true);
            $xml->endElement(); //PAYTO
        }

        if ($this->getReturnToContactName() !== null) {
            $xml->startElement('RETURNTO');
            $xml->writeElement('CONTACTNAME', $this->getReturnToContactName(), true);
            $xml->endElement(); //RETURNTO
        }

        $xml->writeElement('PAYMETHODKEY', $this->getPreferredPaymentMethod());
        $xml->writeElement('MERGEPAYMENTREQ', $this->isMergePaymentRequests());
        $xml->writeElement('PAYMENTNOTIFY', $this->isSendAutomaticPaymentNotification());
        $xml->writeElement('BILLINGTYPE', $this->getVendorBillingType());

        // TODO: Default bill payment date

        $xml->writeElement('PAYMENTPRIORITY', $this->getPaymentPriority());
        $xml->writeElement('TERMNAME', $this->getPaymentTerm());
        $xml->writeElement('DISPLAYTERMDISCOUNT', $this->isTermDiscountDisplayedOnCheckStub());
        $xml->writeElement('ACHENABLED', $this->isAchEnabled());
        $xml->writeElement('ACHBANKROUTINGNUMBER', $this->getAchBankRoutingNo());
        $xml->writeElement('ACHACCOUNTNUMBER', $this->getAchBankAccountNo());
        $xml->writeElement('ACHACCOUNTTYPE', $this->getAchBankAccountType());
        $xml->writeElement('ACHREMITTANCETYPE', $this->getAchBankAccountClass());

        // TODO: Check delivery and ACH payment services fields

        $xml->writeElement('VENDORACCOUNTNO', $this->getVendorAccountNo());
        $xml->writeElement('DISPLAYACCTNOCHECK', $this->isLocationAssignedAccountNoDisplayedOnCheckStub());

        // TODO: Location assigned account numbers

        $xml->writeElement('OBJECTRESTRICTION', $this->getRestrictionType());
        if (count($this->getRestrictedLocations()) > 0) {
            $xml->writeElement('RESTRICTEDLOCATIONS', $this->getRestrictedLocations());
        }
        if (count($this->getRestrictedDepartments()) > 0) {
            $xml->writeElement('RESTRICTEDDEPARTMENTS', $this->getRestrictedDepartments());
        }

        $this->writeXmlImplicitCustomFields($xml);

        $xml->endElement(); //VENDOR
        $xml->endElement(); //update

        $xml->endElement(); //function
    }
}
