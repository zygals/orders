<?php

namespace app\wx\controller;

use app\wx\model\CateShop;
use app\wx\model\Shop;
use think\Request;
use think\Url;

class ShopController extends BaseController {
    public function get_shop() {
        return json((new Shop())->getShop());
    }
}
