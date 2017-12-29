<?php

include('app\Society.php');
include ('header.php');
include ('app\controller\TemplateEngineController.php');
include ('app\controller\ProductController.php');
include('app\controller\MatchController.php');
include ('app\controller\UsersController.php');

include ('app\model\interfaces\Manageable.php');
include ('app\model\interfaces\Destroyable.php');
include ('app\model\CoreModel.php');
include ('app\model\Product.php');
include('app\model\MatchHistory.php');
include ('app\model\Users.php');

define ("SALT", "Labas vakaras brangioji");