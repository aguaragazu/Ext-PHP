<?php

class Oficina extends msDB
{
    public $grid;

    public function __construct()
    {
        $this->connect();
        $this->grid = new Grid();
        $this->grid->setTable('oficinas');
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
                    'field' => 'oficina',
                    'name' => 'oficina',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Oficina', 'width' => 200, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'referencia',
                    'name' => 'referencia',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Referencia', 'width' => 200, 'sortable' => false),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'tel_numero1',
                    'name' => 'tel_numero1',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Teléfono 1', 'width' => 90, 'sortable' => false),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'tel_numero2',
                    'name' => 'tel_numero2',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Teléfono 2', 'width' => 90, 'sortable' => false),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'tel_numero3',
                    'name' => 'tel_numero3',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Teléfono 3', 'width' => 90, 'sortable' => false),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'tel_interno1',
                    'name' => 'tel_interno1',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Int 1', 'width' => 90, 'sortable' => false),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'tel_interno2',
                    'name' => 'tel_interno2',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Int 2', 'width' => 90, 'sortable' => false),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'tel_interno3',
                    'name' => 'tel_interno3',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Int 3', 'width' => 90, 'sortable' => false),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'cel_numero',
                    'name' => 'cel_numero',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Celular', 'width' => 90, 'sortable' => false),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'email',
                    'name' => 'email',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Email', 'width' => 50, 'sortable' => false),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'spep',
                    'name' => 'spep',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'SPEP', 'width' => 50, 'sortable' => false),
                    ),
                )
        );
    }

    public function create($request)
    {
        $data = array(
          'oficina' => $request['oficina'],
          'referencia' => $request['referencia'],
          'tel_numero1' => $request['tel_numero1'],
          'tel_numero2' => $request['tel_numero2'],
          'tel_numero3' => $request['tel_numero3'],
          'tel_interno1' => $request['tel_interno1'],
          'tel_interno2' => $request['tel_interno2'],
          'tel_interno3' => $request['tel_interno3'],
          'cel_numero' => $request['cel_numero'],
          'email' => $request['email'],
          'spep' => $request['spep'],
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
          'oficina' => $request['oficina'],
          'referencia' => $request['referencia'],
          'tel_numero1' => $request['tel_numero1'],
          'tel_numero2' => $request['tel_numero2'],
          'tel_numero3' => $request['tel_numero3'],
          'tel_interno1' => $request['tel_interno1'],
          'tel_interno2' => $request['tel_interno2'],
          'tel_interno3' => $request['tel_interno3'],
          'cel_numero' => $request['cel_numero'],
          'email' => $request['email'],
          'spep' => $request['spep'],
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
