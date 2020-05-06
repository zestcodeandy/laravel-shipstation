<?php
namespace LaravelShipStation\Helpers;

class Orders extends Endpoint
{
    /**
     * Create a single order in ShipStation.
     *
     * @param  array  $order
     * @return \stdClass
     */
    public function create($order)
    {
        return $this->post($order, 'createorder');
    }

    /**
     * Does the specified order exist by the given order number?
     *
     * @param  mixed  $orderNumber
     * @return bool
     */
    public function existsByOrderNumber($orderNumber)
    {
        $orderId = $this->getOrderId($orderNumber);

        return $orderId ? true : false;
    }

    /**
     * How many orders are awaiting shipment?
     *
     * @return int|null
     */
    public function awaitingShipmentCount()
    {
        $count = $this->get([
            'orderStatus' => 'awaiting_shipment'
        ]);

        return isset($count->total) ? $count->total : null;
    }

    public function list((array) $filter = null)
    {
        $count = $this->get($filter);

        return $count;
    }

    public function awaitingPaymentCount()
    {
        $count = $this->get([
            'orderStatus' => 'awaiting_payment'
        ]);

        return isset($count->total) ? $count->total : null;
    }
}
