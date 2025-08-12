<?php
namespace ThomasSens\SicoobBundle\Service;

class SicoobClient

{
    public function __construct(
        public BoletoService $boleto,
        public PixService $pix
    ) {}

}