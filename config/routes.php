<?php
/**
 * CakePHP Plugin : CakePHP Subdomain Routing
 * Copyright (c) Multidimension.al (http://multidimension.al)
 * Github : https://github.com/multidimension-al/cakephp-subdomains
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE file
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     (c) Multidimension.al (http://multidimension.al)
 * @link          https://github.com/multidimension-al/cakephp-subdomains Github
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Blnsoftware\Subdomains\Config;

use App\BridgeLoanNetwork\Http\Middleware\CsrfProtectionMiddleware;
use Blnsoftware\Subdomains\Routing\Route\SubdomainRoute;
use Blnsoftware\Subdomains\Middleware\SubdomainMiddleware;

use Cake\Routing\Router;

$subdomainsObject = new SubdomainMiddleware();
$subdomains = $subdomainsObject->getSubdomains();

if (is_array($subdomains)) {
    foreach ($subdomains AS $prefix) {
        Router::scope('/', ['prefix' => $prefix], function($routes) {
            $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
                'httpOnly' => true
            ]));
            $routes->fallbacks('Blnsoftware/Subdomains.SubdomainRoute');
        });
    }
}
