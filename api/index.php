<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

header('Content-Type:application/json');
require '../common.php';

$split = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$className = ucfirst(strtolower($split[0]));
$route = new \Routes\Items();
$route->run();


/*
 * engineering manager - zoom 1 hr
 * face to face
 *
 *
 *
 *
 *
 *
 * readingroom
 * lots of bespoke and wordpress
 * jquery and native JS
 * versioning through SVN
 *
 * quidco
 * zend, twig, less, memcache, gearman
 * started using SVN, then moved to GIT
 * redevelopment of user interface
 * homepage redevelopment: widgets
 * migration smarty -> twig + bootstrap + less
 * user groups: manual and automated based on criteria
 * notifications system: frontend + API, heavy memcache logic
 *
 * Mangahigh
 * Yaf, giant.js, single page apps, grunt, backbone, wrappers (phonegap, crosswalk, cordova), rabbitmq
 * TDD: behat, phpunit
 *
 * Quidco
 * ELK (elasticsearch, logstash, kibana)
 * maintenance of the old codebase
 * bug fixes, modification of functionalities still in the old codebase
 * migration to PHP7
 * performance optimizations
 *
 *
 * Preparing for job hunt
 * Node.js, React
 *
 */
