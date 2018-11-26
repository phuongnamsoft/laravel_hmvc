<?php 

namespace ModuleEx\Repositories;

class ExRepository extends BaseRepository {

    public function __construct() {
        parent::__construct();
    }

    public function showIndex() {
        return '123';
    }

}