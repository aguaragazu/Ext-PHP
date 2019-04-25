<?php

class Escuela extends msDB
{
    public $grid;

    public function __construct()
    {
        $this->connect();
        $this->grid = new Grid();
        $this->grid->setTable('escuelas');
        $this->grid->addField(
                array(
                    'field' => 'id',
                    'name' => 'id',
                    'primary' => true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'numero',
                    'name' => 'numero',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Número', 'width' => 50, 'sortable' => true),
                      'filter' => array('type' => 'numeric'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'nombre',
                    'name' => 'nombre',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Nombre', 'width' => 150, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'cod_jurisdiccional',
                    'name' => 'cod_jurisdiccional',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Cod. Juris.', 'width' => 60, 'sortable' => true),
                      'filter' => array('type' => 'numeric'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'cue',
                    'name' => 'cue',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'CUE', 'width' => 60, 'sortable' => true),
                      'filter' => array('type' => 'numeric'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'anexo',
                    'name' => 'anexo',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Anexo', 'width' => 50, 'sortable' => true),
                      'filter' => array('type' => 'numeric'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'region',
                    'name' => 'region',
                    'meta' => array(
                      'st' => array('type' => 'strin'),
                      'cm' => array('header' => 'Reg.', 'width' => 50, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'circuito_id',
                    'name' => 'circuito_id',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Circuito', 'width' => 50, 'sortable' => true),
                      'filter' => array('type' => 'numeric'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'nodo',
                    'name' => 'nodo',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Nodo', 'width' => 60, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'turno',
                    'name' => 'turno',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Turno', 'width' => 100, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'domicilio',
                    'name' => 'domicilio',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Domicilio', 'width' => 100, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'tel_numero',
                    'name' => 'tel_numero',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Teléfono', 'width' => 100, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'email',
                    'name' => 'email',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'E-mail', 'width' => 100, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'localidad',
                    'name' => 'localidad',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Localidad', 'width' => 100, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
    }

    public function create($request)
    {
        $data = array(
          'numero' => $request['numero'],
          'nombre' => $request['nombre'],
          'cod_jurisdiccional' => $request['cod_jurisdiccional'],
          'cue' => $request['cue'],
          'anexo' => $request['anexo'],
          'region' => $request['region'],
          'circuito_id' => $request['circuito_id'],
          'nodo' => $request['nodo'],
          'turno' => $request['turno'],
          'domicilio' => $request['domicilio'],
          'tel_numero' => $request['tel_numero'],
          'email' => $request['email'],
          'localidad' => $request['localidad'],
        );

        return $this->grid->doCreate(json_encode($data));
    }

    public function edit($id, $request)
    {
        $this->grid->loadSingle = true;
        $this->grid->setManualFilter(" and id = $id");

        return $this->grid->doRead($request);
    }

    public function read($request)
    {
        return $this->grid->doRead($request);
    }

    public function update($request)
    {
        $data = array(
          'id' => $request['id'],
          'numero' => $request['numero'],
          'nombre' => $request['nombre'],
          'cod_jurisdiccional' => $request['cod_jurisdiccional'],
          'cue' => $request['cue'],
          'anexo' => $request['anexo'],
          'region' => $request['region'],
          'circuito_id' => $request['circuito_id'],
          'nodo' => $request['nodo'],
          'turno' => $request['turno'],
          'domicilio' => $request['domicilio'],
          'tel_numero' => $request['tel_numero'],
          'email' => $request['email'],
          'localidad' => $request['localidad'],
        );

        return $this->grid->doUpdate(json_encode($data));
    }

    public function doReport($request)
    {
        return $this->grid->dosql($request);
    }

    public function destroy($request)
    {
        return $this->grid->doDestroy($request);
    }
}
