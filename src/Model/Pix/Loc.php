<?php

namespace ThomasSens\SicoobBundle\Model\Pix;

class Loc
{
    public function __construct(
        public ?int $id = null,
        public ?string $location = null,
        public ?string $tipoCob = null
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'location' => $this->location,
            'tipoCob' => $this->tipoCob
        ];
    }
}