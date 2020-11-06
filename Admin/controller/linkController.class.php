<?php
namespace Admin\controller;
use \Frame\libs\BaseController;
final class linkController extends BaseController{
    public function index(){
        $this->smarty->display("link/index.html");
    }
}