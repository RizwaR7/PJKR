<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('admin_menu.index', function (BreadcrumbTrail $trail): void {
 $trail->push('Menu', route('admin_menu.index'));
});
