<?php

namespace HDSSolutions\Finpar\Traits;

use HDSSolutions\Finpar\Models\Person;

trait ExtendsPerson {
    use HasIdentity;

    protected static $identityClass = Person::class;

    public static function bootExtendsPerson() {
        self::retrieved(function($model) {
            // append identity fields
            $model->appends += [
                'company_id',
                'firstname',
                'lastname',
                'full_name',
                'documentno',
                'email',
                'phone',
                'gender',
            ];
            // hide identity from json
            $model->hidden += [
                'identity',
            ];
        });
    }

    public function getCompanyIdAttribute() {
        return $this->identity->company_id;
    }

    public function setCurrencyIdAttribute($value) {
        $this->identity->company_id = $value;
    }

    public function company() {
        return $this->identity->company();
    }

    public function getFullNameAttribute():string {
        return $this->business_name ?? ($this->lastname !== null ? $this->lastname.', ' : '').$this->firstname;
    }

    public function getFirstnameAttribute() {
        return $this->identity->firstname;
    }

    public function setFirstnameAttribute($value) {
        $this->identity->firstname = $value;
    }

    public function getLastnameAttribute() {
        return $this->identity->lastname;
    }

    public function setLastnameAttribute($value) {
        $this->identity->lastname = $value;
    }

    public function getDocumentnoAttribute() {
        return $this->identity->documentno;
    }

    public function setDocumentnoAttribute($value) {
        $this->identity->documentno = $value;
    }

    public function getEmailAttribute() {
        return $this->identity->email;
    }

    public function setEmailAttribute($value) {
        $this->identity->email = $value;
    }

    public function getPhoneAttribute() {
        return $this->identity->phone;
    }

    public function setPhoneAttribute($value) {
        $this->identity->phone = $value;
    }

    public function getGenderAttribute() {
        return $this->identity->gender;
    }

    public function setGenderAttribute($value) {
        $this->identity->gender = $value;
    }

}
