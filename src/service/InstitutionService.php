<?php

class InstitutionService {

    private $tableName = 'Institution';
    private $primaryKey = 'Institutionname';

    function get($id) {
        $entity = InstitutionsQuery::create()->findPk($id);

        $data = array();

        if($entity == null){
            $data = helper::getError(404, 'The '.$this->primaryKey.' of the '.$this->tableName.' was not found');
        } else {
            $data['data'] = $entity->toArray();
        }

        return $data;
    }

    function create($array) {
        $object = json_decode($array[$this->tableName]);

        $data = array();

        try {
            $entity = new Institutions();
            $entity->setInstitutionname($object->{$this->primaryKey});
            $entity->setInstitutionurl($object->{'Institutionurl'});
            $entity->save();
            $data['data'] = $entity->toArray();
        } catch (Exception $e) {
            $data = helper::getError(409, $e->getMessage());
        } finally {
            return $data;
        }
    }

    function update($array) {
        $object = json_decode($array[$this->tableName]);

        $data = array();

        $entity = InstitutionsQuery::create()->findOneByInstitutionname($object->{$this->primaryKey});

        if($entity == null) {
            $data = helper::getError(404, 'The '.$this->primaryKey.' of the '.$this->tableName.' was not found');
        } else {
            $entity->setInstitutionurl($object->{'Institutionurl'});
            $entity->save();
            $data['data'] = $entity->toArray();
        }

        return $data;
    }

    function remove($id) {
        $entity = InstitutionsQuery::create()->findOneByInstitutionname($id);

        $data = array();

        if($entity == null){
            $data = helper::getError(404, 'The '.$this->primaryKey.' of the '.$this->tableName.' was not found');
        } else {
            $entity->delete();
            $data['data'] = $entity->toArray();
        }

        return $data;
    }

}