<?php

namespace App\Core;

use App\Core\Database;

class Model extends Database {

    protected $limit = 100;
    protected $offset = 0;
    protected $orderBy = "DESC";
    protected $orderColumn = "id";

    // first() - Returns only one record.
    // all() - Returns all records.
    // where() - Returns a record based on a keyword.
    // insert() - Inserts a new record.
    // update() - Updates a record.
    // delete() - Deletes a record.
    // count() - Counts a certain record.

}
