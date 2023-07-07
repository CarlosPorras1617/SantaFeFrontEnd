<div>
    <h6>{{ $tramite['numEntrada'] }}</h6>
    <h6>{{ $tramite['factura'] }}</h6>
    <h6>{{ $tramite['pedimentoRT'] }}</h6>
    <h6>{{ $tramite['pedimentoA1'] }}</h6>
    <h6>{{ $tramite['cliente'] }}</h6>
    <h6>{{ $tramite['chofer'] }}</h6>
    <h6>{{ $tramite['cellChofer'] }}</h6>
    <h6>{{ $tramite['noLicenciaChofer'] }}</h6>
    <h6>{{ $tramite['placa'] }}</h6>
    <h6>{{ $tramite['economico'] }}</h6>
    <h6>{{ $tramite['candados'] }}</h6>
    <h6>{{ $tramite['numBultos'] }}</h6>
    <h6>{{ $tramite['barcode'] }}</h6>
    <h6>{{ \Carbon\Carbon::parse($tramite['created_at'], 'America/Hermosillo')->format('d/m/y') }}
    </h6>
    <h6>{{ \Carbon\Carbon::parse($tramite['updated_at'], 'America/Hermosillo')->format('d/m/y') }}
    </h6>
</div>
