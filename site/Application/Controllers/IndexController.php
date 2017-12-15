<?php

include_once 'AbstractController.php';

/**
 *  Classe de cria��o e controle da tela inicial do sistema
 * 
 * @author Leonardo Danieli <leonardo.danieli@gmail.com>
 * @version 1.0
 * 
 */
class IndexController extends AbstractController {

    public function init() {
        parent::init();
        $this->IdGrid = 'grid';
        $this->FormName = 'formIndex';
        $this->Action = 'Index';
        $this->TituloLista = "Index";
        $this->TituloEdicao = "Index";
        $this->ItemEditInstanceName = 'IndexEdit';
        $this->ItemEditFormName = 'formIndexItemEdit';
        $this->Model = 'Index';
        $this->IdWindowEdit = 'EditIndex';
        $this->TplIndex = 'Index/index.tpl';
        $this->TplEdit = 'Index/edit.tpl';
    }

    public function indexAction() {
        $view = Zend_Registry::get('view');
        $session = Zend_Registry::get('session');
        $usuario = $session->usuario;

//        $this->redirect('/explore');
//        $view->assign('scriptsJs', Browser_Control::getScriptsJs());
//        $view->assign('scriptsCss', Browser_Control::getScriptsCss());
//        $view->assign('titulo', $this->TituloEdicao);
//        $view->assign('TituloPagina', $this->TituloEdicao);
////        $view->assign('body', $form->displayTpl($view, 'Index/search.tpl'));
////        $view->assign('body', $form->displayTpl($view, 'Index/search.tpl'));
        $view->output('index.tpl');
    }

    public function btnsearchclickAction() {
        $post = Zend_Registry::get('post');
        $br = new Browser_Control();
        $br->setBrowserUrl(BASE_URL . 'explore/index/q/' . $post->serach);
        $br->send();
    }

    public function loadAction() {

    }

    public static function getMenu() {

        $mainMenu = new Ui_Element_MainMenu('menuPrincipal');
        $mainMenu->setParams('200');

        // =========== Menu  ==========
        // INDICADORES
        $menuItem = new Ui_Element_MenuItem('home', 'Home', HTTP_REFERER . 'index/index', '', 'home');
        $mainMenu->addMenuItem($menuItem);

//
//        $menu = new Ui_Element_MenuItem('Recipients', 'Recipients', HTTP_REFERER . 'recipient', '', ''); //, '10 new Dreams');
//        $mainMenu->addMenuItem($menu);
//
//        $menu = new Ui_Element_MenuItem('Offers', 'Offers', HTTP_REFERER . 'offer', '', ''); //, '2 new Trips');
//        $mainMenu->addMenuItem($menu);

        $menu = new Ui_Element_MenuItem('Vouchers', 'Vouchers', HTTP_REFERER . 'voucher', '', 'head');
        $mainMenu->addMenuItem($menu);

//        $menu2 = new Ui_Element_MenuItem('Development', 'Development', '', '', '');
//        $menu2->setVisible(Usuario::getIdUsuarioLogado() == 1);
//        $mainMenu->addMenuItem($menu2);
//        if (true) {
//            $menu3 = new Ui_Element_MenuItem('Users', 'Users', HTTP_REFERER . 'usuario/users', '', '');
////        $menu2->setVisible('PROC_CAD_TOPICO_LAUDO', 'ver');
//            $menu2->addSubMenu($menu3);
//
//            $menu3 = new Ui_Element_MenuItem('groups', 'Groups of Users', HTTP_REFERER . 'usuario/grupos', '', '');
////        $menu2->setVisible('PROC_CAD_TOPICO_LAUDO', 'ver');
//            $menu2->addSubMenu($menu3);
//
//            $menu3 = new Ui_Element_MenuItem('Proccess', 'Proccess', HTTP_REFERER . 'processo', '', '');
////        $menu2->setVisible('PROC_CAD_TOPICO_LAUDO', 'ver');
//            $menu2->addSubMenu($menu3);
//            $menu3 = new Ui_Element_MenuItem('DatabaseUptates', 'Database Uptates', HTTP_REFERER . 'dbupdate', '', '');
////        $menu2->setVisible('PROC_CAD_TOPICO_LAUDO', 'ver');
//            $menu2->addSubMenu($menu3);
//        }
        return $mainMenu->render();
    }

}
