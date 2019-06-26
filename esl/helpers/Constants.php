<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 1/31/18
 * Time: 1:28 PM
 */

namespace Esl\helpers;


class Constants
{
    const STATUS_OK = 200;
    const STATUS_ERROR = 401;
    const LEAD_CUSTOMER = 'lead';
    const EXISTING_CUSTOMER = 'customer';
    const TARIFF_KPA = 'kpa';
    const TARIFF_INTERNAL = 'internal';
    const TARIFF_UNIT_TYPE_LUMPSUM = 'Lumpsum';
    const TARIFF_UNIT_TYPE_GRT = 'grt';
    const TARIFF_UNIT_TYPE_LOA = 'loa';
    const TARIFF_UNIT_TYPE_PERDAY = 'per day';
    const LEAD_QUOTATION_PENDING = 'pending';
    const LEAD_QUOTATION_REQUEST = 'requested';
    const LEAD_QUOTATION_APPROVED = 'approved';
    const LEAD_QUOTATION_REVISION = 'revision';
    const LEAD_QUOTATION_DECLINED = 'disapproved';
    const LEAD_QUOTATION_DECLINED_CUSTOMER = 'declined';
    const LEAD_QUOTATION_CONVERTED = 'converted';
    const LEAD_QUOTATION_CHECKED = 'checked';
    const LEAD_QUOTATION_WAITING = 'waiting';
    const LEAD_QUOTATION_ACCEPTED = 'accepted';
    //po status
    const PO_REQUEST = 'requested';
    const PO_APPROVED = 'approved';
    const PO_DISAPPROVED = 'disapproved';

    const CUSTOMER = 'customer';
    const Q_APPROVAL_TITLE = 'Quotation Approval Request';
    const Q_APPROVED_TITLE = 'Quotation Approved';
    const Q_ACCEPTED_TITLE = 'Quotation Accepted';
    const Q_SEND_TO_CUSTOMER_TITLE = 'PDA sent to customer';
    const Q_SEND_TO_CUSTOMER_TEXT = 'PDA sent to customer  waiting for customer response';
    const Q_CUSTOMER_ACCEPTED_TEXT = 'The customer accepted the PDA';
    const Q_DISAPPROVED_TITLE = 'PDA disapproved';
    const Q_DECLINED_C_TITLE = 'PDA declined';
    const Q_DECLINED_C_TEXT = 'PDA declined by customer';
    const Q_APPROVED_TEXT = 'Your PDA has been approved';
    const Q_DISAPPROVED_TEXT = 'Your PDA has been disapproved';
    const Q_APPROVAL_TEXT = 'You have a new PDA Quotation to approve';
    const DEPARTMENT_AGENCY = 'Agency';
//    transport

    const TRANSPORT_IMPORT = 'Import';
    const TRANSPORT_EXPORT = 'Export';
    const TRANSPORT_ALL = 'all';
    const TRANSPORT_CLEARING = 'Clearing';
    const TRANSPORT_QUOTATION_PENDING = 'Pending';
    const TRANSPORT_TYPE_IMPORT = 'Import';
    const TRANSPORT_TYPE_EXPORT = 'Export';

    const EMAILS_CC = [
        'it.support@esl-eastafrica.com',
        'accounts@esl-eastafrica.com',
        'maurine.atieno@esl-eastafrica.com',
        'imports@freightwell.com',
        'info@freightwell.com',
        'audit@esl-eastafrica.com'];

    const PERMISSIONS = [
        'manage-users' => 'Manage Users',
        'manager' => 'Manager',
        'admin' => 'Admin',
        'approve-quotation' => 'Approve Quotation',
        'manage-contracts' => 'Manage Contracts',
        'generate-quotation' => 'Generate Quotation',
        'view-quotation' => 'View Quotation',
        'add-services' => 'Adding services',
        'add-contracts' => 'Adding contracts',
        'view-services' => 'View services',
        'view-contracts' => 'View contracts',
        'delete-services' => 'Delete services',
        'delete-contracts' => 'Delete contracts',
        'add-stages' => 'Adding stages',
        'view-stages' => 'View stages',
        'delete-stages' => 'Delete stages',
        'add-documents' => 'Adding documents',
        'view-documents' => 'View documents',
        'delete-documents' => 'Delete documents',
        'add-roles' => 'Adding roles',
        'view-roles' => 'View roles',
        'manage-jobs' => 'Manage Jobs',
        'view-customers' => 'View Customers',
        'delete-roles' => 'Delete roles',
        'can-delete' => 'Can  Delete',
    ];
}