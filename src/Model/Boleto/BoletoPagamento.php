<?php

namespace ThomasSens\SicoobBundle\Model\Boleto;

class BoletoPagamento
{
    /**
     * @var string Identificador da consulta do boleto
     */
    private $identificadorConsulta;

    /**
     * @var float Valor nominal do Boleto
     */
    private $valorBoleto;

    /**
     * @var float Valor de desconto/abatimento do pagamento do Boleto
     */
    private $valorDescontoAbatimento;

    /**
     * @var float Valor de mora/multa do pagamento do Boleto
     */
    private $valorMultaMora;

    /**
     * @var string Descrição da observação informada no pagamento
     */
    private $descricaoObservacao;

    /**
     * @var bool Autoriza pagamento com valor divergente
     */
    private $aceitaValorDivergente;

    /**
     * @var string Número do CPF/CNPJ do portador
     */
    private $numeroCpfCnpjPortador;

    /**
     * @var string Nome do portador responsável pelo pagamento
     */
    private $nomePortador;

    /**
     * @var float Valor de pagamento do Boleto
     */
    private $amount;

    /**
     * @var string Data do pagamento do boleto (Formato: yyyy-MM-dd)
     */
    private $date;

    /**
     * @var DebtorAccount Conta do associado
     */
    private $debtorAccount;

    public function __construct(
        $identificadorConsulta,
        $valorBoleto,
        $valorDescontoAbatimento,
        $valorMultaMora,
        $descricaoObservacao,
        $aceitaValorDivergente,
        $numeroCpfCnpjPortador,
        $nomePortador,
        $amount,
        $date,
        DebtorAccount $debtorAccount
    ) {
        $this->identificadorConsulta = $identificadorConsulta;
        $this->valorBoleto = $valorBoleto;
        $this->valorDescontoAbatimento = $valorDescontoAbatimento;
        $this->valorMultaMora = $valorMultaMora;
        $this->descricaoObservacao = $descricaoObservacao;
        $this->aceitaValorDivergente = $aceitaValorDivergente;
        $this->numeroCpfCnpjPortador = $numeroCpfCnpjPortador;
        $this->nomePortador = $nomePortador;
        $this->amount = $amount;
        $this->date = $date;
        $this->debtorAccount = $debtorAccount;
    }

    public function getIdentificadorConsulta()
    {
        return $this->identificadorConsulta;
    }

    public function getValorBoleto()
    {
        return $this->valorBoleto;
    }

    public function getValorDescontoAbatimento()
    {
        return $this->valorDescontoAbatimento;
    }

    public function getValorMultaMora()
    {
        return $this->valorMultaMora;
    }

    public function getDescricaoObservacao()
    {
        return $this->descricaoObservacao;
    }

    public function getAceitaValorDivergente()
    {
        return $this->aceitaValorDivergente;
    }

    public function getNumeroCpfCnpjPortador()
    {
        return $this->numeroCpfCnpjPortador;
    }

    public function getNomePortador()
    {
        return $this->nomePortador;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDebtorAccount()
    {
        return $this->debtorAccount;
    }

    public function toArray()
    {
        return [
            'identificadorConsulta' => $this->identificadorConsulta,
            'valorBoleto' => $this->valorBoleto,
            'valorDescontoAbatimento' => $this->valorDescontoAbatimento,
            'valorMultaMora' => $this->valorMultaMora,
            'descricaoObservacao' => $this->descricaoObservacao,
            'aceitaValorDivergente' => $this->aceitaValorDivergente,
            'numeroCpfCnpjPortador' => $this->numeroCpfCnpjPortador,
            'nomePortador' => $this->nomePortador,
            'amount' => $this->amount,
            'date' => $this->date,
            'debtorAccount' => $this->debtorAccount ? $this->debtorAccount->toArray() : null
        ];
    }
}