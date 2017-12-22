<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

/**
 * PurchaseOrder Record Model Class
 */
class PurchaseOrder_Record_Model extends Inventory_Record_Model
{

    /**
     * This Function adds the specified product quantity to the Product Quantity in Stock
     * @param type $recordId
     */
    function updateStockToProducts($recordId = '')
    {
        if (!empty($recordId)) {
            $recordModel = Inventory_Record_Model::getInstanceById($recordId);
            $type = $recordModel->get('cf_765');
            $inStock = $recordModel->get('cf_767');
            $outStock = $recordModel->get('cf_763');
            $productlist = $recordModel->getProducts();
        } else {
            $type = $this->get('cf_765');
            $inStock = $this->get('cf_767');
            $outStock = $this->get('cf_763');
            $productlist = $this->getProducts();
        }

        $db = PearDatabase::getInstance();

        foreach ($productlist as $i => $product) {
            $qty = $product['qty' . $i];
            $productId = $product['hdnProductId' . $i];
            $listprice = round($product['listPrice' . $i], 2);
            $discount_percent = round($product['discount_percent' . $i], 2);
            $discount_amount = round($product['discount_amount' . $i], 2);
            if (empty($productId) || empty($qty))
                continue;

            $sql = 'SELECT pro.qtyinstock, procf.cf_753, procf.cf_755, procf.cf_757, procf.cf_751 FROM vtiger_products pro INNER JOIN vtiger_productcf procf ON procf.productid=pro.productid WHERE pro.productid=?';
            $result = $db->pquery($sql, array($productId));
            $stock0 = intval($db->query_result($result, 0, 'qtyinstock'));
            $stock1 = intval($db->query_result($result, 0, 'cf_753'));
            $stock2 = intval($db->query_result($result, 0, 'cf_755'));
            $stock3 = intval($db->query_result($result, 0, 'cf_757'));
            $costprice = floatval($db->query_result($result, 0, 'cf_751'));
            $contractprice = $listprice;
            if (!empty($discount_percent)) {
                $contractprice = round($listprice * (1 - $discount_percent / 100), 2);
            } elseif (!empty($discount_amount)) {
                $contractprice = $listprice - $discount_amount;
            }

            if ($type == 'In Stock') {
                if ($inStock == 'Stock-0') {
                    $stock = $stock0 + $qty;
                    $db->pquery('UPDATE vtiger_products SET qtyinstock=? WHERE productid=?', array($stock, $productId));
                } else {
                    if ($inStock == 'Stock-1') {
                        $stock = $stock1 + $qty;
                        $field = 'cf_753';
                    } elseif ($inStock == 'Stock-2') {
                        $stock = $stock2 + $qty;
                        $field = 'cf_755';
                    } else {
                        $stock = $stock3 + $qty;
                        $field = 'cf_757';
                    }
                    $db->pquery('UPDATE vtiger_productcf SET ' . $field . '=? WHERE productid=?', array($stock, $productId));
                }

                $_costprice = round(($costprice * ($stock0 + $stock1 + $stock2 + $stock3) + $contractprice * $qty) / ($stock0 + $stock1 + $stock2 + $stock3 + $qty), 2);
                $db->pquery('UPDATE vtiger_productcf SET cf_751=? WHERE productid=?', array($_costprice, $productId));
            } elseif ($type == 'Out Stock') {
                if ($outStock == 'Stock-0') {
                    $stock = $stock0 - $qty;
                    $db->pquery('UPDATE vtiger_products SET qtyinstock=? WHERE productid=?', array($stock, $productId));
                } else {
                    if ($inStock == 'Stock-1') {
                        $stock = $stock1 - $qty;
                        $field = 'cf_753';
                    } elseif ($inStock == 'Stock-2') {
                        $stock = $stock2 - $qty;
                        $field = 'cf_755';
                    } else {
                        $stock = $stock3 - $qty;
                        $field = 'cf_757';
                    }
                    $db->pquery('UPDATE vtiger_productcf SET ' . $field . '=? WHERE productid=?', array($stock, $productId));
                }

                $_costprice = round(($costprice * ($stock0 + $stock1 + $stock2 + $stock3) - $contractprice * $qty) / ($stock0 + $stock1 + $stock2 + $stock3 - $qty), 2);
                $db->pquery('UPDATE vtiger_productcf SET cf_751=? WHERE productid=?', array($_costprice, $productId));
            } elseif ($type == 'Adjust Stock') {
                if ($inStock != $outStock) {
                    if ($inStock == 'Stock-0') {
                        $stock = $stock0 + $qty;
                        $db->pquery('UPDATE vtiger_products SET qtyinstock=? WHERE productid=?', array($stock, $productId));
                    } else {
                        if ($inStock == 'Stock-1') {
                            $stock = $stock1 + $qty;
                            $field = 'cf_753';
                        } elseif ($inStock == 'Stock-2') {
                            $stock = $stock2 + $qty;
                            $field = 'cf_755';
                        } else {
                            $stock = $stock3 + $qty;
                            $field = 'cf_757';
                        }
                        $db->pquery('UPDATE vtiger_productcf SET ' . $field . '=? WHERE productid=?', array($stock, $productId));
                    }
                    if ($outStock == 'Stock-0') {
                        $stock = $stock0 - $qty;
                        $db->pquery('UPDATE vtiger_products SET qtyinstock=? WHERE productid=?', array($stock, $productId));
                    } else {
                        if ($inStock == 'Stock-1') {
                            $stock = $stock1 - $qty;
                            $field = 'cf_753';
                        } elseif ($inStock == 'Stock-2') {
                            $stock = $stock2 - $qty;
                            $field = 'cf_755';
                        } else {
                            $stock = $stock3 - $qty;
                            $field = 'cf_757';
                        }
                        $db->pquery('UPDATE vtiger_productcf SET ' . $field . '=? WHERE productid=?', array($stock, $productId));
                    }
                }
            }
        }
//		$db = PearDatabase::getInstance();
//
//		$recordModel = Inventory_Record_Model::getInstanceById($recordId);
//		$relatedProducts = $recordModel->getProducts();
//
//		foreach ($relatedProducts as $key => $relatedProduct) {
//			if($relatedProduct['qty'.$key]){
//				$productId = $relatedProduct['hdnProductId'.$key];
//				$result = $db->pquery("SELECT qtyinstock FROM vtiger_products WHERE productid=?", array($productId));
//				$qty = $db->query_result($result,0,"qtyinstock");
//				$stock = $qty + $relatedProduct['qty'.$key];
//				$db->pquery("UPDATE vtiger_products SET qtyinstock=? WHERE productid=?", array($stock, $productId));
//			}
//		}
    }

    /**
     * This Function returns the current status of the specified Purchase Order.
     * @param type $purchaseOrderId
     * @return <String> PurchaseOrderStatus
     */
    function getPurchaseOrderStatus($purchaseOrderId)
    {
        $db = PearDatabase::getInstance();
        $sql = "SELECT postatus FROM vtiger_purchaseorder WHERE purchaseorderid=?";
        $result = $db->pquery($sql, array($purchaseOrderId));
        $purchaseOrderStatus = $db->query_result($result, 0, "postatus");
        return $purchaseOrderStatus;
    }
}