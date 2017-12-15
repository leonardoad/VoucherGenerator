<?php

if (isset($_SERVER['PWD'])) {
    // include of the Configuration for the tests only if the $_SERVER['PWD'] is set,
    // because it means that it is runing on the comand line (PHPUnit)
    include './tests/TestsConfigs.php';
}

// 
/**
 * Voucher Class
 * 
 * @author 		Leonardo Daneili
 * @copyright           Leonardo Danieli
 * @package		system
 * @subpackage          system.application.models
 * @version		1.0
 */
class Voucher extends Db_Table {

    protected $_name = 'voucher'; // table name
    public $_primary = 'id_voucher'; //PK

    function __construct($config = array(), $definition = null) {
        parent::__construct($config, $definition);
    }

    /** set the Voucher data 
     *
     * @param type $id_recip
     * @param type $id_offer
     * @param type $expirationdate
     */
    function setData($id_recip, $id_offer, $expirationdate) {
        $this->setid_recipient($id_recip);
        $this->setid_offer($id_offer);
        $this->setExpirationDate($expirationdate);

        $this->setCode($this->getRandomCode());
    }

    /** return if the voucher Code already exists in the database
     *
     * @return boolean
     */
    function checkIfCodeExists() {
        $voucher = new Voucher();
        $voucher->where('code', $this->getCode());
        return $voucher->count() > 0;
    }

    /**
     *  returns if the Voucher is still valid
     *
     * @return boolean true if is valid
     */
    function isValid() {
        //we get if it is still good or expired
        return DataHora::compareDate2($this->getExpirationDate(), '>=', date('m/d/Y'), 'mm/dd/yyyy', 'mm/dd/yyyy');
    }

    /**
     *  returns if the Voucher was already redeemed
     * 
     * @return boolean true if it was used already
     */
    function isRedeemed() {
        // we get if it wasn't used yet
        return $this->getUsed_at() != '';
    }

    /** Generates a unique code for the giveen recipient, offer and expiration date
     *
     * @return string the code
     */
    function getRandomCode() {
        $code = md5($this->getid_recipient() . $this->getid_offer() . $this->getexpirationdate());
        return $code;
    }

    /** reads a list of vouchers with the recipient and offer info
     *
     * @param string $modo ['obj'|'array'] 
     */
    function readLst($modo = 'obj') {
        $this->join('recipient', 'recipient.id_recipient = voucher.id_recipient', 'recipient.name as recipient, email as recipientemail', 'inner');
        $this->join('offer', 'offer.id_offer = voucher.id_offer', 'offer.name as offer,percent ', 'inner');
        parent::readLst($modo);
    }

}
