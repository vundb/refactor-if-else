<?php

namespace Vundb\IfElse;

/**
 * Class Tool
 *
 * @package Vundb\IfElse
 */
class Tool
{
    /**
     * @param Product $prd
     *
     * @return array
     */
    public function oldMethod(Product $prd)
    {
        if (isset($prd->quantity)) {
            if ($prd->quantity > 0) {
                if (isset($prd->quantity_relation)) {
                    if ($prd->quantity_relation == '=' || $prd->quantity_relation == '>') {
                        $fv['quantity'] = $prd->quantity;
                    } else {
                        $fv['quantity'] = 0;
                    }
                } else {
                    $fv['quantity'] = $prd->quantity;
                }
            } else {
                $fv['quantity'] = 0;
            }
        } elseif (isset($prd->availability)) {
            if ($prd->availability == 'in stock') {
                $fv['quantity'] = 3;
            } else {
                $fv['quantity'] = 0;
            }
        } else {
            $fv['quantity'] = 0;
        }

        return $fv;
    }

    /**
     * @param Product $prd
     *
     * @return array
     */
    public function newMethod(Product $prd)
    {
        $fv = ['quantity' => 0];

        if (isset($prd->quantity)) {
            if ($prd->quantity > 0 && !isset($prd->quantity_relation)) {
                $fv['quantity'] = $prd->quantity;
            }
            if ($prd->quantity > 0 && isset($prd->quantity_relation)
                && ($prd->quantity_relation == '='
                    || $prd->quantity_relation == '>')
            ) {
                $fv['quantity'] = $prd->quantity;
            }
        } else {
            if (isset($prd->availability) && $prd->availability == 'in stock') {
                $fv['quantity'] = 3;
            }
        }

        return $fv;
    }
}
