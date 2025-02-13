<?php

namespace ThomasSens\SicoobBundle\Model;

class ComprovantePagamento
{
    private ?string $numeroAgencia;
    private string $nomeAgencia;
    private int $numeroConta;
    private string $nomeProprietarioContaCorrente;
    private string $numeroLinhaDigitavel;
    private int $numeroInstituicaoEmissora;
    private string $nomeInstituicaoEmissora;
    private ?string $numeroCpfCnpjBeneficiario;
    private ?string $nomeRazaoSocialBeneficiario;
    private ?string $nomeFantasiaBeneficiario;
    private ?string $numeroCpfCnpjBeneficiarioFinal;
    private ?string $nomeRazaoSocialBeneficiarioFinal;
    private ?string $nomeFantasiaBeneficiarioFinal;
    private ?string $numeroCpfCnpjPagador;
    private ?string $nomeRazaoSocialPagador;
    private ?string $nomeFantasiaPagador;
    private string $dataVencimento;
    private float $valorBoleto;
    private float $valorAbatimentoDesconto;
    private float $valorMultaMora;
    private float $valorPagamento;
    private string $dataPagamento;
    private string $situacaoPagamento;
    private string $descricaoDetalheSituacao;
    private string $dataHoraCadastro;
    private bool $aceitaValorDivergente;
    private ?string $nossoNumero;
    private ?string $numeroDocumento;
    private ?string $descricaoObservacao;
    private string $descricaoOuvidoria;
    private string $descricaoTituloComprovante;
    private int $idPagamento;
    private ?string $numeroAutenticacaoPagamento;

    public function __construct(
        string $nomeAgencia,
        int $numeroConta,
        string $nomeProprietarioContaCorrente,
        string $numeroLinhaDigitavel,
        int $numeroInstituicaoEmissora,
        string $nomeInstituicaoEmissora,
        string $dataVencimento,
        float $valorBoleto,
        float $valorAbatimentoDesconto,
        float $valorMultaMora,
        float $valorPagamento,
        string $dataPagamento,
        string $situacaoPagamento,
        string $descricaoDetalheSituacao,
        string $dataHoraCadastro,
        bool $aceitaValorDivergente,
        string $descricaoOuvidoria,
        string $descricaoTituloComprovante,
        int $idPagamento
    ) {
        $this->nomeAgencia = $nomeAgencia;
        $this->numeroConta = $numeroConta;
        $this->nomeProprietarioContaCorrente = $nomeProprietarioContaCorrente;
        $this->numeroLinhaDigitavel = $numeroLinhaDigitavel;
        $this->numeroInstituicaoEmissora = $numeroInstituicaoEmissora;
        $this->nomeInstituicaoEmissora = $nomeInstituicaoEmissora;
        $this->dataVencimento = $dataVencimento;
        $this->valorBoleto = $valorBoleto;
        $this->valorAbatimentoDesconto = $valorAbatimentoDesconto;
        $this->valorMultaMora = $valorMultaMora;
        $this->valorPagamento = $valorPagamento;
        $this->dataPagamento = $dataPagamento;
        $this->situacaoPagamento = $situacaoPagamento;
        $this->descricaoDetalheSituacao = $descricaoDetalheSituacao;
        $this->dataHoraCadastro = $dataHoraCadastro;
        $this->aceitaValorDivergente = $aceitaValorDivergente;
        $this->descricaoOuvidoria = $descricaoOuvidoria;
        $this->descricaoTituloComprovante = $descricaoTituloComprovante;
        $this->idPagamento = $idPagamento;
    }

    public function getNumeroAgencia(): ?string
    {
        return $this->numeroAgencia;
    }

    public function setNumeroAgencia(?string $numeroAgencia): void
    {
        $this->numeroAgencia = $numeroAgencia;
    }

    public function getNomeAgencia(): string
    {
        return $this->nomeAgencia;
    }
    
    // Métodos get/set para os demais atributos podem ser implementados conforme necessário
}
