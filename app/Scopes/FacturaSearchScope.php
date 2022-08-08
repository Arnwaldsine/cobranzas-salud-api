<?php


namespace App\Scopes;


class FacturaSearchScope extends SearchScope
{
    protected $searchColumns = [
    'observaciones',
    'obraSocial.nombre',
    'puntoVenta.nombre',
    'estado.estado'];
}

