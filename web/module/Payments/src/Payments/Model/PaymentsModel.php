<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Payments\Model;

class PaymentsModel
{
    private $payment = [
        [
            'name'      =>  'Item0',
            'desc'      =>  'Description for Item0',
            'amt'       =>  '20.00',
            'number'    =>  '1234',
            'qtv'       =>  '1',
            'tax'       =>  '0.00'
        ],
        [
            'name'      =>  'Item1',
            'desc'      =>  'Description for Item1',
            'amt'       =>  '40.00',
            'number'    =>  '5678',
            'qtv'       =>  '1',
            'tax'       =>  '0.00'
        ],
    ];

    public function findById($id)
    {
        if ( !isset($id) ) {
            throw new \Exception('No id for the payment');
        }

        $payment = $this->payment[$id];

        $item = new \SpeckPaypal\Element\PaymentItem();
        $item->setName($payment['name']);
        $item->setDesc($payment['desc']);
        $item->setAmt($payment['amt']);
        $item->setNumber($payment['number']);
        $item->setQty($payment['qtv']);
        $item->setTaxAmt($payment['tax']);

        return $item;
    }
}
