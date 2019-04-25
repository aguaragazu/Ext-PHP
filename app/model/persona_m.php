<?php

class Persona extends msDB
{
    public $grid;

    public function __construct()
    {
        $this->connect();
        $this->grid = new Grid();
        $this->grid->setTable('personas');
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
                    'field' => 'apellido',
                    'name' => 'apellido',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Apellido', 'width' => 200, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'nombre',
                    'name' => 'nombre',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Nombre', 'width' => 200, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'cel_numero',
                    'name' => 'cel_numero',
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('header' => 'Celular', 'width' => 90, 'sortable' => true, 'renderer' => "Ext.util.Format.date(val,'d/m/Y')"),
                      'filter' => array('type' => 'date'),
                    ),
                )
        );
        $this->grid->addField(
                array(
                    'field' => 'email',
                    'name' => 'email',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Email', 'width' => 50, 'sortable' => true),
                      'filter' => array('type' => 'string'),
                    ),
                )
        );
    }

    public function create($request)
    {
        $data = array(
          'apellido' => $request['apellido'],
          'nombre' => $request['nombre'],
          'cel_numero' => $request['cel_numero'],
          'email' => $request['email'],
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
          'apellido' => $request['apellido'],
          'nombre' => $request['nombre'],
          'cel_numero' => $request['cel_numero'],
          'email' => $request['email'],
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
