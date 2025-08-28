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
                ->scalarNode('environment')->isRequired()->end()
                ->scalarNode('client_id')->isRequired()->end()
                ->scalarNode('cert_path')->isRequired()->end()
                ->scalarNode('cert_key')->isRequired()->end()
                ->scalarNode('cert_password')->isRequired()->end()
            ->end();
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