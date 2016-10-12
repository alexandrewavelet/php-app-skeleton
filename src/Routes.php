<?php

use PhpUtils\Types\Collection;

return new Collection([
    ['GET', '/{name:.*}', ['MyApp\Controllers\Main', 'welcome']],
]);
