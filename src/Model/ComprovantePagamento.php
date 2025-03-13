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
        ?string $numeroAgencia = null,
        string $nomeAgencia,
        int $numeroConta,
        string $nomeProprietarioContaCorrente,
        string $numeroLinhaDigitavel,
        int $numeroInstituicaoEmissora,
        string $nomeInstituicaoEmissora,
        ?string $numeroCpfCnpjBeneficiario = null,
        ?string $nomeRazaoSocialBeneficiario = null,
        ?string $nomeFantasiaBeneficiario = null,
        ?string $numeroCpfCnpjBeneficiarioFinal = null,
        ?string $nomeRazaoSocialBeneficiarioFinal = null,
        ?string $nomeFantasiaBeneficiarioFinal = null,
        ?string $numeroCpfCnpjPagador = null,
        ?string $nomeRazaoSocialPagador = null,
        ?string $nomeFantasiaPagador = null,
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
        ?string $nossoNumero = null,
        ?string $numeroDocumento = null,
        ?string $descricaoObservacao = null,
        string $descricaoOuvidoria,
        string $descricaoTituloComprovante,
        int $idPagamento,
        ?string $numeroAutenticacaoPagamento = null
    ) {
        $this->numeroAgencia = $numeroAgencia;
        $this->nomeAgencia = $nomeAgencia;
        $this->numeroConta = $numeroConta;
        $this->nomeProprietarioContaCorrente = $nomeProprietarioContaCorrente;
        $this->numeroLinhaDigitavel = $numeroLinhaDigitavel;
        $this->numeroInstituicaoEmissora = $numeroInstituicaoEmissora;
        $this->nomeInstituicaoEmissora = $nomeInstituicaoEmissora;
        $this->numeroCpfCnpjBeneficiario = $numeroCpfCnpjBeneficiario;
        $this->nomeRazaoSocialBeneficiario = $nomeRazaoSocialBeneficiario;
        $this->nomeFantasiaBeneficiario = $nomeFantasiaBeneficiario;
        $this->numeroCpfCnpjBeneficiarioFinal = $numeroCpfCnpjBeneficiarioFinal;
        $this->nomeRazaoSocialBeneficiarioFinal = $nomeRazaoSocialBeneficiarioFinal;
        $this->nomeFantasiaBeneficiarioFinal = $nomeFantasiaBeneficiarioFinal;
        $this->numeroCpfCnpjPagador = $numeroCpfCnpjPagador;
        $this->nomeRazaoSocialPagador = $nomeRazaoSocialPagador;
        $this->nomeFantasiaPagador = $nomeFantasiaPagador;
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
        $this->nossoNumero = $nossoNumero;
        $this->numeroDocumento = $numeroDocumento;
        $this->descricaoObservacao = $descricaoObservacao;
        $this->descricaoOuvidoria = $descricaoOuvidoria;
        $this->descricaoTituloComprovante = $descricaoTituloComprovante;
        $this->idPagamento = $idPagamento;
        $this->numeroAutenticacaoPagamento = $numeroAutenticacaoPagamento;
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
    
    public function getNumeroConta(): int
    {
        return $this->numeroConta;
    }

    public function setNumeroConta(int $numeroConta): self
    {
        $this->numeroConta = $numeroConta;
        return $this;
    }

    public function getNomeProprietarioContaCorrente(): string
    {
        return $this->nomeProprietarioContaCorrente;
    }

    public function setNomeProprietarioContaCorrente(string $nomeProprietarioContaCorrente): self
    {
        $this->nomeProprietarioContaCorrente = $nomeProprietarioContaCorrente;
        return $this;
    }

    public function getNumeroLinhaDigitavel(): string
    {
        return $this->numeroLinhaDigitavel;
    }

    public function setNumeroLinhaDigitavel(string $numeroLinhaDigitavel): self
    {
        $this->numeroLinhaDigitavel = $numeroLinhaDigitavel;
        return $this;
    }

    public function getNumeroInstituicaoEmissora(): int
    {
        return $this->numeroInstituicaoEmissora;
    }

    public function setNumeroInstituicaoEmissora(int $numeroInstituicaoEmissora): self
    {
        $this->numeroInstituicaoEmissora = $numeroInstituicaoEmissora;
        return $this;
    }

    public function getNomeInstituicaoEmissora(): string
    {
        return $this->nomeInstituicaoEmissora;
    }

    public function setNomeInstituicaoEmissora(string $nomeInstituicaoEmissora): self
    {
        $this->nomeInstituicaoEmissora = $nomeInstituicaoEmissora;
        return $this;
    }

    public function getNumeroCpfCnpjBeneficiario(): ?string
    {
        return $this->numeroCpfCnpjBeneficiario;
    }

    public function setNumeroCpfCnpjBeneficiario(?string $numeroCpfCnpjBeneficiario): self
    {
        $this->numeroCpfCnpjBeneficiario = $numeroCpfCnpjBeneficiario;
        return $this;
    }

    public function getNomeRazaoSocialBeneficiario(): ?string
    {
        return $this->nomeRazaoSocialBeneficiario;
    }

    public function setNomeRazaoSocialBeneficiario(?string $nomeRazaoSocialBeneficiario): self
    {
        $this->nomeRazaoSocialBeneficiario = $nomeRazaoSocialBeneficiario;
        return $this;
    }

    public function getNomeFantasiaBeneficiario(): ?string
    {
        return $this->nomeFantasiaBeneficiario;
    }

    public function setNomeFantasiaBeneficiario(?string $nomeFantasiaBeneficiario): self
    {
        $this->nomeFantasiaBeneficiario = $nomeFantasiaBeneficiario;
        return $this;
    }

    public function getNumeroCpfCnpjBeneficiarioFinal(): ?string
    {
        return $this->numeroCpfCnpjBeneficiarioFinal;
    }

    public function setNumeroCpfCnpjBeneficiarioFinal(?string $numeroCpfCnpjBeneficiarioFinal): self
    {
        $this->numeroCpfCnpjBeneficiarioFinal = $numeroCpfCnpjBeneficiarioFinal;
        return $this;
    }

    public function getNomeRazaoSocialBeneficiarioFinal(): ?string
    {
        return $this->nomeRazaoSocialBeneficiarioFinal;
    }

    public function setNomeRazaoSocialBeneficiarioFinal(?string $nomeRazaoSocialBeneficiarioFinal): self
    {
        $this->nomeRazaoSocialBeneficiarioFinal = $nomeRazaoSocialBeneficiarioFinal;
        return $this;
    }

    public function getNomeFantasiaBeneficiarioFinal(): ?string
    {
        return $this->nomeFantasiaBeneficiarioFinal;
    }

    public function setNomeFantasiaBeneficiarioFinal(?string $nomeFantasiaBeneficiarioFinal): self
    {
        $this->nomeFantasiaBeneficiarioFinal = $nomeFantasiaBeneficiarioFinal;
        return $this;
    }

    public function getNumeroCpfCnpjPagador(): ?string
    {
        return $this->numeroCpfCnpjPagador;
    }

    public function setNumeroCpfCnpjPagador(?string $numeroCpfCnpjPagador): self
    {
        $this->numeroCpfCnpjPagador = $numeroCpfCnpjPagador;
        return $this;
    }

    public function getNomeRazaoSocialPagador(): ?string
    {
        return $this->nomeRazaoSocialPagador;
    }

    public function setNomeRazaoSocialPagador(?string $nomeRazaoSocialPagador): self
    {
        $this->nomeRazaoSocialPagador = $nomeRazaoSocialPagador;
        return $this;
    }

    public function getNomeFantasiaPagador(): ?string
    {
        return $this->nomeFantasiaPagador;
    }

    public function setNomeFantasiaPagador(?string $nomeFantasiaPagador): self
    {
        $this->nomeFantasiaPagador = $nomeFantasiaPagador;
        return $this;
    }

    public function getDataVencimento(): string
    {
        return $this->dataVencimento;
    }

    public function setDataVencimento(string $dataVencimento): self
    {
        $this->dataVencimento = $dataVencimento;
        return $this;
    }

    public function getValorBoleto(): float
    {
        return $this->valorBoleto;
    }

    public function setValorBoleto(float $valorBoleto): self
    {
        $this->valorBoleto = $valorBoleto;
        return $this;
    }

    public function getValorAbatimentoDesconto(): float
    {
        return $this->valorAbatimentoDesconto;
    }

    public function setValorAbatimentoDesconto(float $valorAbatimentoDesconto): self
    {
        $this->valorAbatimentoDesconto = $valorAbatimentoDesconto;
        return $this;
    }

    public function getValorMultaMora(): float
    {
        return $this->valorMultaMora;
    }

    public function setValorMultaMora(float $valorMultaMora): self
    {
        $this->valorMultaMora = $valorMultaMora;
        return $this;
    }

    public function getValorPagamento(): float
    {
        return $this->valorPagamento;
    }

    public function setValorPagamento(float $valorPagamento): self
    {
        $this->valorPagamento = $valorPagamento;
        return $this;
    }

    public function getDataPagamento(): string
    {
        return $this->dataPagamento;
    }

    public function setDataPagamento(string $dataPagamento): self
    {
        $this->dataPagamento = $dataPagamento;
        return $this;
    }

    public function getSituacaoPagamento(): string
    {
        return $this->situacaoPagamento;
    }

    public function setSituacaoPagamento(string $situacaoPagamento): self
    {
        $this->situacaoPagamento = $situacaoPagamento;
        return $this;
    }

    public function getDescricaoDetalheSituacao(): string
    {
        return $this->descricaoDetalheSituacao;
    }

    public function setDescricaoDetalheSituacao(string $descricaoDetalheSituacao): self
    {
        $this->descricaoDetalheSituacao = $descricaoDetalheSituacao;
        return $this;
    }

    public function getDataHoraCadastro(): string
    {
        return $this->dataHoraCadastro;
    }

    public function setDataHoraCadastro(string $dataHoraCadastro): self
    {
        $this->dataHoraCadastro = $dataHoraCadastro;
        return $this;
    }

    public function getAceitaValorDivergente(): bool
    {
        return $this->aceitaValorDivergente;
    }

    public function setAceitaValorDivergente(bool $aceitaValorDivergente): self
    {
        $this->aceitaValorDivergente = $aceitaValorDivergente;
        return $this;
    }

    public function getNossoNumero(): ?string
    {
        return $this->nossoNumero;
    }

    public function setNossoNumero(?string $nossoNumero): self
    {
        $this->nossoNumero = $nossoNumero;
        return $this;
    }

    public function getNumeroDocumento(): ?string
    {
        return $this->numeroDocumento;
    }

    public function setNumeroDocumento(?string $numeroDocumento): self
    {
        $this->numeroDocumento = $numeroDocumento;
        return $this;
    }

    public function getDescricaoObservacao(): ?string
    {
        return $this->descricaoObservacao;
    }

    public function setDescricaoObservacao(?string $descricaoObservacao): self
    {
        $this->descricaoObservacao = $descricaoObservacao;
        return $this;
    }

    public function getDescricaoOuvidoria(): string
    {
        return $this->descricaoOuvidoria;
    }

    public function setDescricaoOuvidoria(string $descricaoOuvidoria): self
    {
        $this->descricaoOuvidoria = $descricaoOuvidoria;
        return $this;
    }

    public function getDescricaoTituloComprovante(): string
    {
        return $this->descricaoTituloComprovante;
    }

    public function setDescricaoTituloComprovante(string $descricaoTituloComprovante): self
    {
        $this->descricaoTituloComprovante = $descricaoTituloComprovante;
        return $this;
    }

    public function getIdPagamento(): int
    {
        return $this->idPagamento;
    }

    public function setIdPagamento(int $idPagamento): self
    {
        $this->idPagamento = $idPagamento;
        return $this;
    }

    public function getNumeroAutenticacaoPagamento(): ?string
    {
        return $this->numeroAutenticacaoPagamento;
    }

    public function setNumeroAutenticacaoPagamento(?string $numeroAutenticacaoPagamento): self
    {
        $this->numeroAutenticacaoPagamento = $numeroAutenticacaoPagamento;
        return $this;
    }
}
