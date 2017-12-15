<?php

include_once getcwd() . '/Application/Controllers/AbstractController.php';

/**
 * This is a Controller accessible without login
 */
class WebController extends AbstractController {

    /**
     * Provide an endpoint, reachable via HTTP, which receives a Voucher Code and Email
     *   and validates the Voucher Code. In Case it is valid, return the Percentage Discount
     *   and set the date of usage
     *
     *
     */
    public function redeemAction() {
        $post = Zend_Registry::get('post');

        $voucherLst = new Voucher();
        $voucherLst->where('recipient.email', $post->email);
        $voucherLst->where('code', $post->code);
        $voucherLst->readLst();
//        print'<pre>';
//        die(print_r($voucherLst));

        if ($voucherLst->countItens() > 0) {
            for ($i = 0; $i < $voucherLst->countItens(); $i++) {
                /* @var $voucher Voucher */
                $voucher = $voucherLst->getItem($i);
                if ($voucher->isRedeemed()) {
//            In Case it is already Redeemd, return the date and a error message
                    $return['error'] = true;
                    $return['errorMessage'] = "Sorry, but this voucher was already used";
                    $return['used_at'] = $voucher->getUsed_at();
                } elseif ($voucher->isValid()) {
//            In Case it is valid, return the Percentage Discount and set the date of usage
                    $return['error'] = false;
                    $return['errorMessage'] = "";
                    $return['offer'] = $voucher->getOffer();
                    $return['discount'] = $voucher->getPercent();
                    $return['expirationDate'] = $voucher->getExpirationDate();
                } else {
                    $return['error'] = true;
                    $return['errorMessage'] = "Sorry, but this voucher is expired and can't be used enymore";
                    $return['expirationDate'] = $voucher->getexpirationDate();
                }
            }
        } else {
            $return['error'] = true;
            $return['errorMessage'] = "Invalid Voucher Code or Email";
        }

        die(json_encode($return));
    }

    /**
     * Provide an endpoint, reachable via HTTP, which receives an Email
     *   and returns the valid vouchers
     */
    public function vouchersAction() {
        $post = Zend_Registry::get('post');

        $voucherLst = new Voucher();
        $voucherLst->where('recipient.email', $post->email);
        $voucherLst->where('expirationdate', date('Y-m-d'), '>=');
        $voucherLst->where('used_at', 'is null');
        $voucherLst->readLst();

        if ($voucherLst->countItens() > 0) {
            $return['error'] = false;
            $return['errorMessage'] = "";
            for ($i = 0; $i < $voucherLst->countItens(); $i++) {
                /* @var $voucher Voucher */
                $voucher = $voucherLst->getItem($i);
                $item['offer'] = $voucher->getOffer();
                $item['discount'] = $voucher->getPercent();
                $item['expirationDate'] = $voucher->getExpirationDate();
                $return['vouchers'][] = $item;
            }
        } else {
            $return['error'] = true;
            $return['errorMessage'] = "Invalid Email or no valid vouchers";
        }

        die(json_encode($return));
    }

}
