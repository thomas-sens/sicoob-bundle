<?php

namespace ThomasSens\SicoobBundle\Model\Boleto;

class DebtorAccount
{
    /**
     * @var int Número da cooperativa da conta
     */
    private $issuer;

    /**
     * @var int Número da Conta onde será realizado o débito para o pagamento
     */
    private $number;

    /**
     * @var int Tipo da conta (0 - Conta Corrente)
     */
    private $accountType;

    /**
     * @var int Tipo pessoa (0 - Pessoa Física, 1 - Pessoa Jurídica)
     */
    private $personType;

    public function __construct($issuer, $number, $accountType, $personType)
    {
        $this->issuer = $issuer;
        $this->number = $number;
        $this->accountType = $accountType;
        $this->personType = $personType;
    }

    public function getIssuer()
    {
        return $this->issuer;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getAccountType()
    {
        return $this->accountType;
    }

    public function getPersonType()
    {
        return $this->personType;
    }

    public function toArray()
    {
        return [
            'issuer' => $this->issuer,
            'number' => $this->number,
            'accountType' => $this->accountType,
            'personType' => $this->personType
        ];
    }
}