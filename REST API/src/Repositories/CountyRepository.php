<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;

class CountyRepository extends BaseRepository
{
    function __construct(
        $host = App\Database\DB::HOST, 
        $user = App\Database\DB::USER,
        $password = App\Database\DB::PASSWORD,
        $database = App\Database\DB::DATABASE)
        {
            parent::__construct($host,$user,$password,$database);
            $this->tableName = 'counties';
        }
}