<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {

    public $guarded = ["id","created_at","updated_at"];

    public static function findRequested()
    {
        $query = Job::query();

        // search results based on user input
        \Request::input('id') and $query->where('id',\Request::input('id'));
        \Request::input('name') and $query->where('name','like','%'.\Request::input('name').'%');
        \Request::input('company') and $query->where('company','like','%'.\Request::input('company').'%');
        \Request::input('salary') and $query->where('salary',\Request::input('salary'));
        \Request::input('details') and $query->where('details',\Request::input('details'));
        \Request::input('location_id') and $query->where('location_id',\Request::input('location_id'));
        \Request::input('type_id') and $query->where('type_id',\Request::input('type_id'));
        \Request::input('classification_id') and $query->where('classification_id',\Request::input('classification_id'));
        \Request::input('user_id') and $query->where('user_id',\Request::input('user_id'));
        \Request::input('created_at') and $query->where('created_at',\Request::input('created_at'));
        \Request::input('updated_at') and $query->where('updated_at',\Request::input('updated_at'));
        
        // sort results
        \Request::input("sort") and $query->orderBy(\Request::input("sort"),\Request::input("sortType","asc"));

        // paginate results
        return $query->paginate(15);
    }

    public static function validationRules( $attributes = null )
    {
        $rules = [
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'salary' => 'required|integer',
            'details' => 'required',
            'location_id' => 'required|integer',
            'type_id' => 'required|integer',
            'classification_id' => 'required|integer',
            'user_id' => 'required|integer',
        ];

        // no list is provided
        if(!$attributes)
            return $rules;

        // a single attribute is provided
        if(!is_array($attributes))
            return [ $attributes => $rules[$attributes] ];

        // a list of attributes is provided
        $newRules = [];
        foreach ( $attributes as $attr )
            $newRules[$attr] = $rules[$attr];
        return $newRules;
    }

}
