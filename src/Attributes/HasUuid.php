<?php

declare(strict_types=1);

namespace KDuma\Eloquent\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class HasUuid
{
    public function __construct(
        public readonly string $field = 'uuid',
        public readonly bool $checkDuplicates = false,
    ) {}
}
