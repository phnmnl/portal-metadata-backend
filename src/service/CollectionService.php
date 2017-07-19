<?php

class CollectionService
{
    function filterBy($array){

        $query = CulturalobjectsQuery::create();

        if(isset($array['institution'])) {
            $arr = explode(',', $array['institution']);
            $institutions = InstitutionsQuery::create()->findByInstitutionname($arr);
            $query->filterByInstitutions($institutions);
        }

        if(isset($array['exhibition'])) {
            $arr = explode(',', $array['exhibition']);
            $exhibitions = ExhibitionQuery::create()->findByExid($arr);
            $query->filterByExhibition($exhibitions);
        }

        if(isset($array['group'])) {
            $arr = explode(',', $array['group']);

            foreach ($arr as $val) {
                $query->condition($val,'Culturalobjects.CulturalGroup LIKE ?', '%'.$val.'%');
            }

            $query->where($arr, 'or');
        }

        if(isset($array['material'])) {
            $arr = explode(',', $array['material']);

            foreach ($arr as $val) {
                $query->condition($val,'Culturalobjects.Materials LIKE ?', '%'.$val.'%');
            }

            $query->where($arr, 'or');
        }

        if(isset($array['type'])) {

            $arr = explode(',', $array['type']);

            foreach ($arr as $val) {
                $query->condition($val,'Culturalobjects.ObjectType LIKE ?', '%'.$val.'%');
            }

            $query->where($arr, 'or');
        }

        if(isset($array['keyword'])) {

            $arr = explode(',', $array['keyword']);
            $temp = array();

            foreach ($arr as $val) {
                $query->condition($val.'1', 'Culturalobjects.Object Like ?', '%'.$val.'%');
                $query->condition($val.'2','Culturalobjects.Description Like ?', '%'.$val.'%');
                $temp[] = $val.'1';
                $temp[] = $val.'2';
            }

            $query->where($temp, 'or');

        }


        if(    isset($array['institution'])
            || isset($array['group'])
            || isset($array['material'])
            || isset($array['type'])
            || isset($array['keyword'])
            || isset($array['exhibition'])
        ) {
            $entity = $query->find();
        } else {
            $entity = null;
        }

        $data = array();

        if($entity == null){
            $data['data']['size'] = 0;
            $data['data']['collection'] = 0;
        } else {
            $data['data']['size'] = count($entity->toArray());
            $data['data']['collection'] = $entity->toArray();
        }

        return $data;

    }

    function getMediaObjectByCoid($id) {

        $entity = MediaobjectsQuery::create()->findByFkCoid($id);

        $data = array();

        if($entity == null){
            $data['data']['size'] = 0;
            $data['data']['collection'] = 0;
        } else {
            $data['data']['size'] = count($entity->toArray());
            $data['data']['collection'] = $entity->toArray();
        }

        return $data;
    }

    function getAssociatedMediaObjectByCoid($id) {

        $entity = AssociatedmediaobjectsQuery::create()->findByFkCoid($id);

        $data = array();

        if($entity == null){
            $data['data']['size'] = 0;
            $data['data']['collection'] = 0;
        } else {
            $data['data']['size'] = count($entity->toArray());
            $data['data']['collection'] = $entity->toArray();
        }

        return $data;
    }
}