<?php
namespace ThomasSens\SicoobBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class SicoobBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
            ->scalarNode('api_url')->cannotBeEmpty()->defaultValue('https://sandbox.sicoob.com.br/sicoob/sandbox/')->info('Endpoint for the Sicoob Server API')->example('https://sandbox.sicoob.com.br/sicoob/sandbox/')->end()
            ->scalarNode('api_token')->cannotBeEmpty()->defaultValue('1301865f-c6bc-38f3-9f49-666dbcfc59c3')->info('API Token of user with access to Sicoob server')->example('1301865f-c6bc-38f3-9f49-666dbcfc59c3')->end()
            ->scalarNode('client_id')->cannotBeEmpty()->defaultValue('9b5e603e428cc477a2841e2683c92d21')->info('Client ID of user with access to Sicoob server')->example('9b5e603e428cc477a2841e2683c92d21')->end()
            ->end();
        ;
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.yaml');
        $this->recursiveSettingContainerParameters($builder, ['sicoob'], $config);
    }

    protected function recursiveSettingContainerParameters(&$container, array $pathArray, array $array)
    {
        foreach ($array AS $key => $value) {
            if (is_array($value)) {
                $pathArray[] = $key;
                $this->recursiveSettingContainerParameters($container, $pathArray, $value);
            } else {
                $container->setParameter(implode('.', $pathArray) . '.' . $key, $value);
            }
        }
    }

}