<?php

namespace Stagem\ZfcCmsBlock;

return [

    'templates' =>  [
        'paths' => [
            'content'    => [__DIR__ . '/../view/question'],
            'admin-cms-block'  => [__DIR__ . '/../view/admin/content'],
        ],
    ],

    'view_helpers' => [
        'aliases' => [
            'cmsBlock' => View\Helper\CmsBlockHelper::class,
        ],
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Model']
            ],
            'orm_default' => [
                'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    __NAMESPACE__ . '\Model' => __NAMESPACE__ . '_driver'
                ]
            ]
        ],
    ],

];
