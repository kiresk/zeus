<?php

namespace Database;

class ZeusSQL extends \mysqli {
    const STRING = 's';
    const DOUBLE = 'd';
    const INTEGER = 'i';
    const BLOB = 'b';

    const ARRAY_STRING = 1;
    const ARRAY_DOUBLE = 2;
    const ARRAY_INTEGER = 3;
    const ARRAY_BLOB = 4;

    public $host;
    public $username;
    public $password;
    public $database;
    public $port;
    public $socket;

    PUBLIC function __construct() {
        // Load config - database module
        $config = \Config::load(\Config::MOD_DB);
        // Set config to class attributes
        $this->host = $config['host'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->database = $config['database'];
        $this->port = intval($config['port']);
        $this->socket = $config['socket'];

        parent::__construct($this->host, $this->username, $this->password, $this->database, $this->port, $this->socket);
    }

    PUBLIC function ExecuteQuery(string $SQL, array $parameters = []) {
        $PreparedQuery = self::PrepareQueryStatement($SQL, $parameters);

        if ($stm = $this->prepare($PreparedQuery['SQL'])) {
            if (count($PreparedQuery['UsedParameters']) > 0) {
                $BindTypes = '';
                $BindValues = [];

                foreach ($PreparedQuery['UsedParameters'] as $Parameter) {
                    switch ($Parameter[1]) {
                        case self::ARRAY_BLOB:
                            if (is_array($Parameter[0])) {
                                foreach ($Parameter[0] as $value) {
                                    $BindTypes .= self::BLOB;
                                    $BindValues[] = $value;
                                }
                            } else {
                                $BindTypes .= self::BLOB;
                                $BindValues[] = $Parameter[0];
                            }
                            break;
                        case self::ARRAY_DOUBLE:
                            if (is_array($Parameter[0])) {
                                foreach ($Parameter[0] as $value) {
                                    $BindTypes .= self::DOUBLE;
                                    $BindValues[] = $value;
                                }
                            } else {
                                $BindTypes .= self::DOUBLE;
                                $BindValues[] = $Parameter[0];
                            }
                            break;
                        case self::ARRAY_INTEGER:
                            if (is_array($Parameter[0])) {
                                foreach ($Parameter[0] as $value) {
                                    $BindTypes .= self::INTEGER;
                                    $BindValues[] = $value;
                                }
                            } else {
                                $BindTypes .= self::INTEGER;
                                $BindValues[] = $Parameter[0];
                            }
                            break;
                        case self::ARRAY_STRING:
                            if (is_array($Parameter[0])) {
                                foreach ($Parameter[0] as $value) {
                                    $BindTypes .= self::STRING;
                                    $BindValues[] = $value;
                                }
                            } else {
                                $BindTypes .= self::STRING;
                                $BindValues[] = $Parameter[0];
                            }
                            break;
                        default:
                            $BindTypes .= $Parameter[1];
                            $BindValues[] = $Parameter[0];
                            break;
                    }
                }
                $stm->bind_param($BindTypes, ...$BindValues);
            }
        } else {
            $this->HandleError($SQL);
            exit;
        }

        if ($stm->execute()) {

            $result = $stm->get_result();
            $stm->close();

            return $result;
        }

        return FALSE;
    }

    PRIVATE STATIC function PrepareQueryStatement($SQL, $parameters) {
        if ((sizeof($parameters) == 0) || (!is_array($parameters))) {
            return array(
                'SQL' => $SQL,
                'UsedParameters' => [],
                'UnusedParameters' => [],
            );
        }

        $UsedParameters = [];
        $UnusedParameters = $parameters;

        if (sizeof($parameters) > 0) {
            foreach ($parameters as $key => $parameter) {
                if (is_array($parameter[0]) && count($parameter[0]) == 0) {
                    switch ($parameter[1]) {
                        case self::ARRAY_STRING:
                        case self::ARRAY_INTEGER:
                        case self::ARRAY_DOUBLE:
                        case self::ARRAY_BLOB:
                            $parameters[$key][0] = [NULL];
                            break;
                    }
                }
            }
        }

        $SQL = preg_replace_callback('/:([[:alnum:]]+)/', function ($match) use (&$UsedParameters, &$UnusedParameters, $parameters) {

            if (array_key_exists($match[1], $parameters)) {
                array_push($UsedParameters, $parameters[$match[1]]);
                unset($UnusedParameters[$match[1]]);
            } else {
                trigger_error('Could not bind parameter; SQL query contains placeholder ' . $match[0] . ' not listed as a parameter.', E_USER_ERROR);
                exit;
            }

            if (is_array($parameters[$match[1]][0])) {
                $placeholders = [];
                for ($i = 0; $i < count($parameters[$match[1]][0]); $i++) {
                    $placeholders[] = '?';
                }
                return implode(', ', $placeholders);
            }
            return '?';
        }, $SQL);

        return array(
            'SQL' => $SQL,
            'UsedParameters' => $UsedParameters,
            'UnusedParameters' => $UnusedParameters,
        );
    }

    PRIVATE function HandleError($SQL) {
        $caller = (debug_backtrace());
        $caller0 = $caller[1];
        $caller1 = $caller[2];
        trigger_error(mysqli_error($this) . ", SQL query: <pre>" . $SQL . '</pre> Error occured in <strong>' . $caller1['class'] . $caller1['type'] . $caller1['function'] . '</strong> called from <strong>' . $caller0['file'] . '</strong> on line <strong>' . $caller0['line'] . '</strong>' . "\n<br /><br />Catched by SQL error handler", E_USER_ERROR);
    }

    PUBLIC function __destruct() {
        $this->close();
    }
}