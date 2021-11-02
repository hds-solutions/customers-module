<?php

namespace HDSSolutions\Laravel\Traits;

use HDSSolutions\Laravel\Models\Person;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

trait ExtendsPerson {
    use HasIdentity;

    protected static $identityClass = Person::class;

    public function getRouteKeyName() {
        // return key name with table (JOIN makes ambiguous id fields)
        return $this->getTable().'.'.$this->getKeyName();
    }

    public function getRouteKey() {
        // return model key value
        return $this->getAttribute($this->getKeyName());
    }

    public function newModelQuery() {
        // get original modelQuery
        return parent::newModelQuery()
            // always JOIN to people
            ->join('people', 'people.id', $this->getTable().'.'.$this->getKeyName());
    }

    public function scopeJoinedPeople(Builder $query) {
        return $query->join('people', 'people.id', $this->getTable().'.'.$this->getKeyName());
    }

    protected function setKeysForSaveQuery($query) {
        // add table name to column (JOIN makes mabiguois id fields)
        return $query->where($this->getTable().'.'.$this->getKeyName(), $this->getKeyForSaveQuery());
    }

    public static function bootExtendsPerson() {
        // add scope lo load people from company only
        self::addGlobalScope(new class implements Scope {
            public function apply(Builder $query, Model $model) {
                // filter company ID on people table
                return $query->where('people.company_id', backend()->company()?->id);
            }
        });

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
