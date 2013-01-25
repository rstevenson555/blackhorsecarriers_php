<?php
class MSSQLResult implements Iterator
{
    private $result;
    private $position;
    private $row_data;

    public function __construct ($res)
    {
        $this->result = $res;
        echo "construct:---: ";
        var_dump($this->result);
        $this->position = 0;
    }

    public function current ()
    {
        return $this->row_data;
    }

    public function key ()
    {
        return $this->position;
    }

    public function next ()
    {
        $this->position++;
        $this->row_data = mysql_fetch_assoc($this->result);
    }

    public function rewind ()
    {
        $this->position = 0;
        echo "rewind:---: ";
        var_dump($this->result);
        mysql_data_seek($this->result, 0);

        /* The initial call to valid requires that data
            pre-exists in $this->row_data
        */
        $this->row_data = mysql_fetch_assoc($this->result);
    }

    public function valid ()
    {
        return (boolean) $this->row_data;
    }
}
class MSSQLDB
    {
        var $db_connection;

        // Constructor
        function __construct($inFreeTDSServerName, $inUser, $inPassword, $inDatabaseName)
        {
            $this->db_connection    = mssql_connect($inFreeTDSServerName, $inUser,$inPassword)
                        or die('Could not connect to '.$inFreeTDSServerName.' server');

            mssql_select_db($inDatabaseName,$this->db_connection)
                        or die('Could not select to '.$inDatabaseName.' database');
        }

        function  __destruct() {
            mssql_close($this->db_connection);
            disconnect();

        }

        // Generic query function
        function query_database($inQuery)
        {
            // Always include the link identifier (in this case $this->db_connection) in mssql_query
            $query_result     = mssql_query($inQuery, $this->db_connection)
                                    or die('Query failed: '.$inQuery);

            if (strpos($inQuery, 'insert') === false)
            {
                // fetch the results as an array
                $result            = array();
                while ($row = mssql_fetch_assoc($query_result))
                {
                    $result[]    = $row;
                }
                // dispose of the query
                mssql_free_result($query_result);
                return $result; 
            }
            else
            {
                // dispose of the query
                mssql_free_result($query_result);

                // get the last insert id
                $query            = 'select SCOPE_IDENTITY() AS last_insert_id';
                $query_result     = mssql_query($query)
                                            or die('Query failed: '.$query);

                $query_result    = mssql_fetch_object($query_result);

                mssql_free_result($query_result);

                return $query_result->last_insert_id;
            }
        }
    }
?>
