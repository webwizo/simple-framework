<?php

namespace App\Core\Database;

use PDO;
use App\Core\App;

class QueryBuilder
{

    public function get_prefix()
    {
        $database = App::get('config')['database'];

        if($database['prefix']) 
        {
            return $database['prefix'] . '_';
        }

        return null;
    }

    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Select all records from a database table.
     *
     * @param string $table
     */
    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$this->get_prefix()}{$table}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function authenticate($email, $password, $remember = false)
    {

        $statement = $this->pdo->prepare("select * from {$this->get_prefix()}users WHERE email = :email");

        $statement->execute([
            ":email" => $email,
        ]);

        $user = $statement->fetch(PDO::FETCH_OBJ);
        
        if($user)
        {
            $hash = $user->password;
            if( check_hash($password, $hash) )
            {
                return $user;
            }
        }
        
        return false;
    }

    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function insert($table, $parameters)
    {
        $now = date('Y-m-d H:i:s');

        $prefix = $this->get_prefix();

        $parameters = array_merge($parameters, [
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $prefix . $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (\Exception $e) {
            //
        }
    }
}
