<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
    DAMA\DoctrineTestBundle\DAMADoctrineTestBundle::class => ['test' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle::class => ['dev' => true, 'test' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    Liip\TestFixturesBundle\LiipTestFixturesBundle::class => ['test' => true],
    Symfony\Bundle\DebugBundle\DebugBundle::class => ['dev' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => ['dev' => true, 'test' => true],
    App\Resources\ResourcesBundle::class => ['all' => true],
    Somnambulist\Bundles\ApiBundle\SomnambulistApiBundle::class => ['all' => true],
    Somnambulist\Bundles\FractalBundle\SomnambulistFractalBundle::class => ['all' => true],
    Somnambulist\Bundles\FormRequestBundle\SomnambulistFormRequestBundle::class => ['all' => true],
    Somnambulist\Bundles\ReadModelsBundle\SomnambulistReadModelsBundle::class => ['all' => true],
];
