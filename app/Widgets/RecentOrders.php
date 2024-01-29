<?php

namespace App\Widgets;
use App\Admin\Sale;

use Arrilot\Widgets\AbstractWidget;

class RecentOrders extends AbstractWidget
{
    public $reloadTimeout = 1; 
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $orders = Sale::latest('created_at')->paginate(10);
        return view('widgets.recent_orders', [
            'config' => $this->config,
            'orders' => $orders
        ]);
    }

    public function placeholder()
    {
        return 'Loading...';
    }
}
