<?php

/**
 * Modelo da classe Mensagem
 * @filesource
 * @author 		Leonardo Daneili
 * @copyright 	Leonardo Danieli
 * @package		 system
 * @subpackage	system.application.models
 * @version		1.0
 */
class Recipient extends Db_Table {

    protected $_name = 'recipient';
    public $_primary = 'id_recipient';

    function __construct($config = array(), $definition = null) {
        parent::__construct($config, $definition);
    }

    function readLst($modo = 'obj') {
        parent::readLst($modo);
    }

}
