<?php

use PhpUtils\Types\Collection;

return new Collection([
    ['GET', '/',            ['TsrDoc\Controllers\Documentation', 'homepage']],
    ['GET', '/{path:.+}',   ['TsrDoc\Controllers\Documentation', 'folder']],
]);
