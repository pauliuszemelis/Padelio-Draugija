<?php

include('app\Society.php');

include ('app\controller\TemplateEngineController.php');
include('app\controller\MatchController.php');
include ('app\controller\UsersController.php');


include ('app\model\interfaces\Manageable.php');
include ('app\model\interfaces\Destroyable.php');
include ('app\model\CoreModel.php');
include('app\model\MatchHistory.php');
include ('app\model\Users.php');
include ('header.php');

define ("SALT", "Labas vakaras brangioji");