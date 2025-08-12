# SicoobBundle
Sicoob integration for Symfony

Instalation:
```
composer require thomas-sens/sicoob-bundle 
```

Generate a parameters file:
```
php bin/console config:dump-reference SicoobBundle > config/packages/sicoob.yaml
```

Example: src/config/packages/sicoob.yaml
```
sicoob:
    api_url:              'https://sandbox.sicoob.com.br/sicoob/sandbox/'
    api_token:            1301865f-c6bc-38f3-9f49-666dbcfc59c3
    client_id:            9b5e603e428cc477a2841e2683c92d21 
```

Call Example:
```
class SicoobController extends AbstractController
{
    #[Route('/sicoob', name: 'app_sicoob')]
    public function index(SicoobClient $sicoob): Response
    {
        // Boleto
        $sicoob->boleto->consultarBoleto($codigoBarras, $numeroConta, $dataPagamento);
        $sicoob->boleto->pagarBoleto($codigoBarras, $boletoPagamento);

        // Pix
        $sicoob->pix->criarCobranca($cobrancaImediata); 
        $sicoob->pix->consultarCobranca($txid, $revisao)
    }
}
```