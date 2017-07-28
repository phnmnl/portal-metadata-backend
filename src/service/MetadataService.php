<?php

class MetadataService {

    private $tableName = 'Metadata';
    private $primaryKey = 'Idmetadata';

    function getJenkinsReport() {

        return PhenomenalJenkinsReport::get_json_report();
    }

    function getGoogleKey() {

        $output = shell_exec('python service-account.py');
        $output = preg_replace("/\r\n|\r|\n/",'',$output);
        header('Content-type: application/json');
        $sub = array ('key'=>$output);
        $arr = array ('result'=>1,'data'=>$sub);

        return $arr;
    }

    function get($id) {
        $entity = MetadataQuery::create()->findPk($id);

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
            $entity = new Metadata();
            $entity->setIdmetadata($object->{$this->primaryKey});
            $entity->setIsaccepttermcondition($object->{'Isaccepttermcondition'});
            $entity->setIsregistergalaxy($object->{'Isregistergalaxy'});
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

        $entity = MetadataQuery::create()->findOneByIdmetadata($object->{$this->primaryKey});

        if($entity == null) {
            $data = helper::getError(404, 'The '.$this->primaryKey.' of the '.$this->tableName.' was not found');
        } else {
            $entity->setIsaccepttermcondition($object->{'Isaccepttermcondition'});
            $entity->setIsregistergalaxy($object->{'Isregistergalaxy'});
            $entity->save();
            $data['data'] = $entity->toArray();
        }

        return $data;
    }

    function remove($id) {
        $entity = MetadataQuery::create()->findOneByIdmetadata($id);

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