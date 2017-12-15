<?php

include_once 'AbstractController.php';

/** Controller responsible for the creation and requests for the voucher management
 *
 */
class VoucherController extends AbstractController {

    public function init() {
        parent::init();
        $this->IdGrid = 'grid';
        $this->FormName = 'formVoucher';
        $this->Action = 'Voucher';
        $this->TituloLista = "Voucher";
        $this->TituloEdicao = "Voucher";
        $this->ItemEditInstanceName = 'VoucherEdit';
        $this->ItemEditFormName = 'formVoucherItemEdit';
        $this->Model = 'Voucher';
        $this->IdWindowEdit = 'EditVoucher';
        $this->TplIndex = 'Voucher/index.tpl';
        $this->TplEdit = 'Voucher/edit.tpl';
    }

    /**
     * 
     */
    public function indexAction() {
        $post = Zend_Registry::get('post');
        $form = new Ui_Form();
        $form->setName($this->FormName);
        $form->setAction($this->Action);

        ////-------- Grid   --------------------------------------------------------------
        $form = new Ui_Form();
        $form->setName($this->FormName);
        $form->setAction($this->Action);

        $idGrid = $this->IdGrid;
        $grid = new Ui_Element_DataTables($idGrid);
        $grid->setParams('', BASE_URL . $this->Action . '/list');
//        $grid->setShowLengthChange(false);
//        $grid->setShowPager(false);
        $grid->setOrder('DataCadastro', 'desc');
//        $grid->setFillListOptions('FichaTecnica', 'readFichatecnicaLst');

        $button = new Ui_Element_DataTables_Button('btnEdit', 'Edit');
        $button->setImg('edit');
        $button->setHref(HTTP_REFERER . $this->Action . '/edit');
        $button->setVisible('PROC_MENSAGENS', 'editar');
        $grid->addButton($button);

        $button = new Ui_Element_DataTables_Button('btnDelete', 'Delete');
        $button->setImg('trash');
        $button->setAttrib('msg', "Are you sure that you want to delete this?");
        $button->setVisible('PROC_MENSAGENS', 'excluir');
        $grid->addButton($button);




        $column = new Ui_Element_DataTables_Column_Text('Offer', 'offer');
        $column->setWidth('2');
        $grid->addColumn($column);

        $column = new Ui_Element_DataTables_Column_Text('Recipient', 'recipient');
        $column->setWidth('3');
        $grid->addColumn($column);

        $column = new Ui_Element_DataTables_Column_Text('Recipient Email', 'recipientemail');
        $column->setWidth('3');
        $grid->addColumn($column);

        $column = new Ui_Element_DataTables_Column_Text('Code', 'Code');
        $column->setWidth('2');
        $grid->addColumn($column);

        $column = new Ui_Element_DataTables_Column_Date('expirationdate', 'expirationdate');
        $column->setWidth('1');
        $grid->addColumn($column);
        $column = new Ui_Element_DataTables_Column_Date('Used At', 'Used_at');
        $column->setWidth('1');
        $grid->addColumn($column);



        $form->addElement($grid);



        // =========================================================================
//
        $button = new Ui_Element_Btn('btnEdit');
        $button->setDisplay('Generete Vouchers', 'plus');
        $button->setHref(HTTP_REFERER . $this->Action . '/edit');
        $button->setType('success');
        $button->setVisible('PROC_TRIP', 'inserir');
        $form->addElement($button);


        $view = Zend_Registry::get('view');
        $view->assign('msg1', urldecode($post->msg1));
        $view->assign('msg2', str_replace('|', '<br>', urldecode($post->msg2)));

        $view->assign('scriptsJs', Browser_Control::getScriptsJs());
        $view->assign('scriptsCss', Browser_Control::getScriptsCss());
        $view->assign('titulo', $this->TituloLista);
        $view->assign('TituloPagina', $this->TituloLista);

        $view->assign('body', $form->displayTpl($view, $this->TplIndex));
        $view->output('index.tpl');
    }

    public function editAction() {
        $br = new Browser_Control();
        $post = Zend_Registry::get('post');
//        $id_indicador = $post->id;

        $view = Zend_Registry::get('view');
        if (isset($post->id)) {
            // if some field needs to be readonly on the item edition, use this variable;
//            $readOnly = true;
        }


        $form = new Ui_Form();
        $form->setAction($this->Action);
        $form->setName($this->ItemEditFormName);
        $form->setAttrib('enctype', 'multipart/form-data');


        $element = new Ui_Element_Select('id_offer', 'Select the Offer to generate the Vouchers');
        $element->addMultiOptions(Db_Table::getOptionList2('id_offer', 'name', 'name', 'offer'));
        $form->addElement($element);


        $element = new Ui_Element_Date('expirationdate', "Expiration Date of this Voucher");
        $form->addElement($element);




        $button = new Ui_Element_Btn('btnSave');
        $button->setDisplay('Save', 'check');
        $button->setType('success');
        $button->setAttrib('click', '');
        if (isset($post->id)) {
            $button->setAttrib('params', 'id = ' . $post->id);
        }
        $button->setAttrib('sendFormFields', '1');
        $button->setAttrib('validaObrig', '1');
        $form->addElement($button);

        $cancelar = new Ui_Element_Btn('btnCancel');
        $cancelar->setAttrib('params', 'IdWindowEdit = ' . $this->IdWindowEdit);
        $cancelar->setDisplay('Cancel', 'times');
        $cancelar->setHref(BASE_URL . $this->Action);
        $form->addElement($cancelar);

        $form->setDataSession();

        $view->assign('scriptsJs', Browser_Control::getScriptsJs());
        $view->assign('scriptsCss', Browser_Control::getScriptsCss());
        $view->assign('titulo', $this->TituloEdicao);
        $view->assign('TituloPagina', $this->TituloEdicao);
        $view->assign('body', $form->displayTpl($view, $this->TplEdit));
        $view->output('index.tpl');
    }

    public function btnsaveclickAction() {
        $post = Zend_Registry::get('post');
        $br = new Browser_Control();


        // creates a Voucher Instance to later add the vouchers to save
        $voucherLst = new Voucher();

        //reads all the Recipients on the DB
        $recipients = new Recipient();
        $recipients->readLst();

        // Now we have to create a voucher for each Recipient
        for ($i = 0; $i < $recipients->countItens(); $i++) {
            //gets the recipient
            $recip = $recipients->getItem($i);

            //creates a new Voucher instance
            $voucher = new Voucher();
            // set the Voucher data
            $voucher->setData($recip->getID(), $post->id_offer, $post->expirationdate);

            //checks if the Code generated for the new Voucher already exist
            if ($voucher->checkIfCodeExists()) {
                //if the code exist, we store it to alert the user
                $notCreatedVoucherTo[] = $recip->getID();
            } else {
                //else, we add to the Voucher list to save
                $voucherLst->add($voucher);
            }
        }



        try {
            //tries to save the list of new Vouchers
            $voucherLst->save();
        } catch (Exception $exc) {
            //if something goes wrong on the db side, we create an alert to the user
            $br->setAlert('Erro!', $exc->getMessage(), '600', '600');
            $br->send();
            die();
        }

        // checks if there was any voucher not created 
        if (count($notCreatedVoucherTo) > 0) {
            //creates an Recipient instance to get its name
            $recipients = new Recipient();
            foreach ($notCreatedVoucherTo as $id_recipinet) {
                // adds the Recipient ID to the where clause
                $recipients->where('id_recipient', $id_recipinet, '=', 'or');
            }
            //reads the list of Recipients that the Voucher was not generated
            $recipients->readLst('array');

            // goes through every recipient to get its name
            foreach ($recipients->getItens() as $recip) {
                $names[] = $recip['name'];
            }

            // creates a string with the msg of the recipients that the voucher was not generated
            $namesMsg = "The following recipients already have a voucher for this offer on this date:||";
            $namesMsg .= implode('|', $names);
        }

        //sets the string with the count of Generated Vouchers
        $msgSuccess = "Vouchers generated: {$voucherLst->countItens()} ";

        //set de browser location url to the Voucher controller on the action Index and passing the message of success and errors
        $br->setBrowserUrl(BASE_URL . $this->Action . '/index/msg1/' . urlencode($msgSuccess) . '/msg2/' . urlencode($namesMsg));
        
        // echoes the json to the javascript request
        $br->send();
    }

}
