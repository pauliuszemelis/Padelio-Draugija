<?php
include (__DIR__.'/app/Club.php');

include (__DIR__.'/app/controller/TemplateEngineController.php');
include (__DIR__.'/app/controller/MatchHistoryController.php');
include (__DIR__.'/app/controller/MatchPlanController.php');
include (__DIR__.'/app/controller/UsersController.php');

include (__DIR__.'/app/model/interfaces/Manageable.php');
include (__DIR__.'/app/model/interfaces/Destroyable.php');
include (__DIR__.'/app/model/CoreModel.php');
include (__DIR__.'/app/model/MatchHistory.php');
include (__DIR__.'/app/model/MatchPlan.php');
include (__DIR__.'/app/model/Users.php');

include (__DIR__.'/header.php');
define ("SALT", "Labas vakaras brangioji");
?>

