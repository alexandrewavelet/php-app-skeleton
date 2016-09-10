<?php

use PhpUtils\Types\Collection;

return new Collection([
    ['GET', '/',            ['Skeleton\Controllers\Documentation', 'homepage']],
    ['GET', '/{path:.+}',   ['Skeleton\Controllers\Documentation', 'folder']],
]);
