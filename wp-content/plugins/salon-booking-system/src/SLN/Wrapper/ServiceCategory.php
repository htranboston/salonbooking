<?php

class SLN_Wrapper_ServiceCategory {

    protected $object;

    public function __construct($object) {
        if (!is_object($object)) {
            $object = get_term($object, SLN_Plugin::TAXONOMY_SERVICE_CATEGORY);
        }
        if(SLN_Helper_Multilingual::isMultilingual() ){
            $objectLanguage = SLN_Helper_Multilingual::getTermLanguage($object->term_id,SLN_Plugin::TAXONOMY_SERVICE_CATEGORY);
            $defaultLanguage = SLN_Helper_Multilingual::getDefaultLanguage();
            $currentLanguage = SLN_Helper_Multilingual::getCurrentLanguage();
            if($defaultLanguage !== $currentLanguage && $defaultLanguage === $objectLanguage){
                $this->translationObject = get_term(SLN_Helper_Multilingual::translateTermId($object->term_id,SLN_Plugin::TAXONOMY_SERVICE_CATEGORY, $currentLanguage));
                $this->translationObjectId = $this->translationObject->term_id;
            }else{
                $this->translationObjectId = $object->term_id;
                $this->translationObject = $object;
                
            }
            
            if($defaultLanguage !== $objectLanguage ){
                $object  = get_term(SLN_Helper_Multilingual::translateTermId($this->translationObjectId,SLN_Plugin::TAXONOMY_SERVICE_CATEGORY));
            }
        }
        
        $this->object = $object;
    }

    public function getId() {
        return $this->object->term_id;
    }

    public function getName() {
        $object = SLN_Helper_Multilingual::isMultilingual()  ? $this->translationObject : $this->object;
        return $object->name;
    }

}
