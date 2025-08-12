<?php

namespace ThomasSens\SicoobBundle\Model\Boleto;

class BoletoConsulta
{       
    public int $numeroInstituicaoEmissora;
    public string $nomeInstituicaoEmissora;
    public ?string $tipoPessoaBeneficiario;
    public ?string $numeroCpfCnpjBeneficiario;
    public ?string $nomeRazaoSocialBeneficiario;
    public ?string $nomeFantasiaBeneficiario;
    public ?string $tipoPessoaBeneficiarioFinal;
    public ?string $numeroCpfCnpjBeneficiarioFinal;
    public ?string $nomeRazaoSocialBeneficiarioFinal;
    public ?string $nomeFantasiaBeneficiarioFinal;
    public ?string $tipoPessoaPagador;
    public ?string $numeroCpfCnpjPagador;
    public ?string $nomeRazaoSocialPagador;
    public ?string $nomeFantasiaPagador;
    public string $codigoBarras;
    public string $numeroLinhaDigitavel;
    public string $dataVencimentoBoleto;
    public ?string $dataLimitePagamentoBoleto;
    public float $valorBoleto;
    public float $valorAbatimentoDesconto;
    public float $valorMultaMora;
    public float $valorPagamento;
    public ?string $dataPagamento;
    public bool $permiteAlterarValor;
    public bool $consultaEmContingencia;
    public ?int $codigoEspecieDocumento;
    public ?string $codigoSituacaoBoletoPagamento;
    public ?string $nossoNumero;
    public ?string $numeroDocumento;
    public ?string $identificadorConsulta;
    public ?string $descricaoInstrucaoDesconto1;
    public ?string $descricaoInstrucaoDesconto2;
    public ?string $descricaoInstrucaoDesconto3;
    public string $descricaoInstrucaoValorMinMax;
    public bool $bloquearPagamento;
    public ?string $mensagemBloqueioPagamento;

    // Getters e Setters
    public function __call(string $name, array $arguments)
    {
        if (str_starts_with($name, 'get')) {
            $property = lcfirst(substr($name, 3));
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        } elseif (str_starts_with($name, 'set')) {
            $property = lcfirst(substr($name, 3));
            if (property_exists($this, $property) && count($arguments) === 1) {
                $this->$property = $arguments[0];
            }
        }
        throw new \BadMethodCallException("Método {$name} não encontrado.");
    }

    public function getValorBoleto(): float
    {
        return $this->valorBoleto;
    }

    public function setValorBoleto(float $valorBoleto): void
    {
        $this->valorBoleto = $valorBoleto;
    }

    public function getValorAbatimentoDesconto(): float
    {
        return $this->valorAbatimentoDesconto;
    }

    public function setValorAbatimentoDesconto(float $valorAbatimentoDesconto): void
    {
        $this->valorAbatimentoDesconto = $valorAbatimentoDesconto;
    }

    public function getValorMultaMora(): float
    {
        return $this->valorMultaMora;
    }

    public function setValorMultaMora(float $valorMultaMora): void
    {
        $this->valorMultaMora = $valorMultaMora;
    }

    public function getValorPagamento(): float
    {
        return $this->valorPagamento;
    }

    public function setValorPagamento(float $valorPagamento): void
    {
        $this->valorPagamento = $valorPagamento;
    }

}