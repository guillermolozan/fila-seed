<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class SystemCluster extends Cluster
{
    protected static ?string $navigationGroup = 'Configuración';

    protected static ?string $navigationLabel = 'Acceso';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 6000;

    protected static ?string $slug = 'sistema';

    protected static ?string $title = 'Sistema';

}
