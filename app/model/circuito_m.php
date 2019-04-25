<?php

class Circuito extends msDB
{
    public $grid;

    public function __construct()
    {
        $this->connect();
        $this->grid = new Grid();
        $this->grid->setTable('circuitos');
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
                      'cm' => array('header' => 'Numero', 'width' => 20, 'sortable' => true),
                      'filter' => array('type' => 'int'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'nivel',
                    'name' => 'nivel',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Nivel', 'width' => 90, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'zona',
                    'name' => 'zona',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Zona', 'width' => 50, 'sortable' => true),
                      'filter' => array('type' => 'numeric'),
                    ),
                )
        );
    }

    public function create($request)
    {
        $data = array(
          'numero' => $request['numero'],
          'nivel' => $request['nivel'],
          'zona' => ($request['zona'] ? $request['zona'] : 'N'),
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
          'nivel' => $request['nivel'],
          'zona' => ($request['zona'] ? $request['zona'] : 'N'),
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
