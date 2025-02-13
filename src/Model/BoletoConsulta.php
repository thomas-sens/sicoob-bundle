<?php

namespace ThomasSens\SicoobBundle\Model;

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
}