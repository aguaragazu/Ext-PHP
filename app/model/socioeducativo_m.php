<?php

class Socioeducativo extends msDB
{
    private $grid;

    public function __construct()
    {
        $this->connect();
        $this->grid = new Grid();
        $this->grid->setTable('socioeducativo');
        $this->grid->addField(
                array(
                    'field' => 'id',
                    'name' => 'id',
                    'primary' => true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false),
                    ),
    )
    );
        $this->grid->addField(
            array(
                'field' => 'escuela_id',
                'name' => 'escuela_id',
                'meta' => array(
                  'st' => array('type' => 'int'),
                  'cm' => array('header' => 'Escuela', 'width' => 50, 'sortable' => true),
                  'filter' => array('type' => 'numeric'),
                ),
            )
    );
        $this->grid->addField(
            array(
                'field' => 'ticket_id',
                'name' => 'ticket_id',
                'meta' => array(
                  'st' => array('type' => 'string'),
                  'cm' => array('header' => 'Ticket-Expte', 'width' => 100, 'sortable' => true),
                  'filter' => array('type' => 'string'),
                ),
            )
    );
        $this->grid->addField(
                array(
                    'field' => 'fecha',
                    'name' => 'fecha',
                    'meta' => array(
                      'st' => array('type' => 'date'),
                      'cm' => array('header' => 'Fecha Jefatura', 'width' => 90, 'sortable' => true, 'renderer' => "Ext.util.Format.date(val,'d/m/Y')"),
                      'filter' => array('type' => 'date'),
                    ),
                )
         );
        $this->grid->addField(
            array(
                'field' => 'alumno_dni',
                'name' => 'alumno_dni',
                'meta' => array(
                  'st' => array('type' => 'int'),
                  'cm' => array('header' => 'Alumno DNI', 'width' => 50, 'sortable' => true),
                  'filter' => array('type' => 'numeric'),
                ),
            )
    );
        $this->grid->addField(
            array(
                'field' => 'alumno',
                'name' => 'alumno',
                'meta' => array(
                  'st' => array('type' => 'string'),
                  'cm' => array('header' => 'Alumno', 'width' => 100, 'sortable' => true),
                  'filter' => array('type' => 'string'),
                ),
            )
    );
        $this->grid->addField(
            array(
                'field' => 'descripcion',
                'name' => 'descripcion',
                'meta' => array(
                  'st' => array('type' => 'string'),
                  'cm' => array('header' => 'Descripción', 'width' => 350, 'sortable' => true),
                  'filter' => array('type' => 'string'),
                ),
            )
    );
        $this->grid->addField(
            array(
                'field' => 'ingreso_region',
                'name' => 'ingreso_region',
                'meta' => array(
                  'st' => array('type' => 'string'),
                  'cm' => array('header' => 'Ingresó a Región', 'width' => 50, 'sortable' => true),
                  'filter' => array('type' => 'string'),
                ),
            )
    );
        $this->grid->addField(
                array(
                    'field' => 'ingreso_region_fecha',
                    'name' => 'ingreso_region_fecha',
                    'meta' => array(
                      'st' => array('type' => 'date'),
                      'cm' => array('header' => 'Fecha Ingreso a Región', 'width' => 90, 'sortable' => true, 'renderer' => "Ext.util.Format.date(val,'d/m/Y')"),
                      'filter' => array('type' => 'date'),
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
                'field' => 'observaciones',
                'name' => 'observaciones',
                'meta' => array(
                  'st' => array('type' => 'string'),
                  'cm' => array('header' => 'Observaciones', 'width' => 350, 'sortable' => true),
                  'filter' => array('type' => 'string'),
                ),
            )
    );
    }

    public function getSocio($request)
    {
        return $this->grid->doRead($request);
    }

    public function edit($id, $request)
    {
        $this->grid->loadSingle = true;
        $this->grid->setManualFilter(" and id = $id");

        return $this->grid->doRead($request);
    }

    public function getActualizacion($socio_id, $request)
    {
        $grid_order = new Grid();
        $grid_order->setTable('socioeducativo_estados');
        $grid_order->setManualFilter(" and socioeducativo_id = $socio_id");
        $grid_order->addField(
                  array(
                    'field' => 'id',
                    'name' => 'id',
                    'primary' => true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false),
                    ),
                  )
                );
        $grid_order->addField(
                  array(
                    'field' => 'fecha',
                    'name' => 'fecha',
                    'meta' => array(
                      'st' => array('type' => 'date'),
                      'cm' => array('header' => 'Fecha', 'width' => 100, 'sortable' => true, 'align' => 'right', 'renderer' => "Ext.util.Format.date(val,'d/m/Y')"),
                    ),
                  )
                );

        $grid_order->addField(
                  array(
                    'field' => 'actualizacion',
                    'name' => 'actualizacion',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Actualización', 'width' => 250, 'sortable' => true),
                    ),
                  )
                );
        $grid_order->addField(
                  array(
                    'field' => 'estado',
                    'name' => 'estado',
                    'meta' => array(
                      'st' => array('type' => 'string'),
                      'cm' => array('header' => 'Estado', 'width' => 100, 'sortable' => false),
                    ),
                  )
                );

        return $grid_order->doRead($request);
    }

    public function create($post)
    {
        /* start build query **/
        $this->db->BeginTrans();
        /** parent query **/
        $str = "INSERT INTO socioeducativos (ticket_id,escuela_id,fecha,alumno_dni,alumno,descripcion,ingreso_region,ingreso_region_fecha,circuito_id,observaciones) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')";
        $query = sprintf(
        $str,
        $post['ticket_id'],
        $post['escuela_id'],
        $post['fecha'],
        $post['alumno_dni'],
        $post['alumno'],
        $post['descripcion'],
        $post['ingreso_region'],
        $post['ingreso_region_fecha'],
        $post['circuito_id'],
        $post['observaciones']
    );

        $this->setSQL($query);
        /** child query **/
        $ok = $this->executeSQL();
        if ($ok) {
            if ('[]' != $post['detail']) {
                $sql = array();
                $socio_id = $this->getLastID();
                $detail = json_decode(stripslashes($post['detail']));
                foreach ($detail as $row) {
                    $col = array();
                    $val = array();
                    $col[] = 'socioeducativo_id';
                    $val[] = $socio_id;
                    foreach ($row as $head => $value) {
                        $col[] = $head;
                        $val[] = "'".$value."'";
                    }
                    $sql[] = sprintf('INSERT INTO socioeducativo_estados (%s) VALUES (%s)', implode(',', $col), implode(',', $val));
                }

                foreach ($sql as $str) {
                    if ($ok) {
                        $this->setSQL($str);
                        $ok = $this->executeSQL();
                    }
                }
            }
        }
        if ($ok) {
            $this->db->CommitTrans();
        } else {
            $this->db->RollbackTrans();
        }
        /** end build query **/
        $result = new stdClass();
        $result->success = ($ok) ? true : false;
        $result->message = $this->db->errorMsg();

        return json_encode($result);
    }

    public function update($post)
    {
        /* start build query **/
        $this->db->BeginTrans();
        /** parent query **/
        $str = "UPDATE socioeducativos 
                SET ticket_id='%s', 
                    escuela_id='%s', 
                    fecha = '%s', 
                    alumno_dni='%s', 
                    alumno = '%s', 
                    descripcion='%s', 
                    ingreso_region = '%s' , 
                    ingreso_region_fecha='%s', 
                    circuito_id = '%s', 
                    observaciones='%s'
                WHERE id = %s";
        $query = sprintf(
        $str,

        $post['ticket_id'],
        $post['escuela_id'],
        $post['fecha'],
        $post['alumno_dni'],
        $post['alumno'],
        $post['descripcion'],
        $post['ingreso_region'],
        $post['ingreso_region_fecha'],
        $post['circuito_id'],
        $post['observaciones'],
        $post['id']
    );

        $this->setSQL($query);
        $ok = $this->executeSQL();
        /* child query update **/
        if ($ok) {
            if ('[]' != $post['detail']) {
                $sql = array();
                $detail = json_decode(stripslashes($post['detail']));
                foreach ($detail as $row) {
                    if (isset($row->id)) {
                        $fields = array();
                        $id = 0;
                        foreach ($row as $head => $value) {
                            if ('id' != $head) {
                                $fields[] = $head.'='."'".$value."'";
                            } else {
                                $id = $value;
                            }
                        }
                        $query = 'UPDATE socioeducativo_estados SET %s WHERE id=%s';
                        $query = sprintf($query, implode(',', $fields), $id);
                        $sql[] = $query;
                    } else {
                        $col = array();
                        $val = array();
                        $col[] = 'socioeducativo_id';
                        $val[] = $post['id'];
                        foreach ($row as $head => $value) {
                            $col[] = $head;
                            $val[] = "'".$value."'";
                        }
                        $sql[] = sprintf('INSERT INTO socioeducativo_estados (%s) VALUES (%s)', implode(',', $col), implode(',', $val));
                    }
                }

                foreach ($sql as $str) {
                    if ($ok) {
                        $this->setSQL($str);
                        $ok = $this->executeSQL();
                    }
                }
            }
        }

        if ($post['remove']) {
            if ($ok) {
                $sql = 'DELETE FROM socioeducativo_estados WHERE id IN (%s)';
                $query = sprintf($sql, $post['remove']);
                $this->setSQL($query);
                $ok = $this->executeSQL();
            }
        }

        if ($ok) {
            $this->db->CommitTrans();
        } else {
            $this->db->RollbackTrans();
        }
        /** end build query **/
        $result = new stdClass();
        $result->success = ($ok) ? true : false;
        $result->message = $this->db->errorMsg();

        return json_encode($result);
    }

    public function destroy($data)
    {
        $this->db->BeginTrans();
        $sql = 'DELETE FROM socioeducativo_estados WHERE buyer_id in(%s)';
        $query = sprintf($sql, $data);
        $this->setSQL($query);
        $ok = $this->executeSQL();
        if ($ok) {
            $sql = 'DELETE FROM socioeducativos WHERE id in (%s)';
            $query = sprintf($sql, $data);
            $this->setSQL($query);
            $ok = $this->executeSQL();
        }

        if ($ok) {
            $this->db->CommitTrans();
        } else {
            $this->db->RollbackTrans();
        }

        $result = new stdClass();
        $result->success = ('' != $this->db->errorMsg()) ? false : true;
        $result->message = $this->db->errorMsg();

        return json_encode($result);
    }
}
