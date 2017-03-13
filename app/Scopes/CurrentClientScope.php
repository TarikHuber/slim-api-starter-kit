<?php

namespace App\Scopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use APILIB\Auth\Authorisation;

class CurrentClientScope implements Scope {

    public function apply(Builder $builder, Model $model) {
           $builder->where('client_id','=', Authorisation::getClient()['id']  );
    }

    public function remove(Builder $builder, Model $model) {

          $query = $builder->getQuery();

          foreach((array)$query->wheres as $key => $where) {

               if($where['column'] == 'client_id') {

                   unset($query->wheres[$key]);

                   $query->wheres = array_values($query->wheres);

               }
         }

     }

}
