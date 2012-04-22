<?php
/**
 * 
 * Table metadata for the Mock_Solar_Model_Users model class.
 * 
 * This class is auto-generated by make-model; any changes you make will be
 * overwritten the next time you use make-model.  Modify the Mock_Solar_Model_Users
 * class instead of this one.
 * 
 */
class Mock_Solar_Model_Users_Metadata extends Solar_Sql_Model_Metadata
{
    public $table_name = 'test_solar_users';
    
    public $table_cols = array (
      'id' => array (
        'name' => 'id',
        'type' => 'int',
        'size' => NULL,
        'scope' => NULL,
        'default' => NULL,
        'require' => true,
        'primary' => true,
        'autoinc' => true,
      ),
      'handle' => array (
        'name' => 'handle',
        'type' => 'varchar',
        'size' => 32,
        'scope' => NULL,
        'default' => NULL,
        'require' => true,
        'primary' => false,
        'autoinc' => false,
      ),
      'passwd' => array (
        'name' => 'passwd',
        'type' => 'varchar',
        'size' => 32,
        'scope' => NULL,
        'default' => NULL,
        'require' => true,
        'primary' => false,
        'autoinc' => false,
      ),
    );
    
    public $index_info = array (
      'handle' => array (
        'type' => 'unique',
        'cols' => array (
          0 => 'handle',
        ),
      ),
      'passwd' => array (
        'type' => 'normal',
        'cols' => array (
          0 => 'passwd',
        ),
      ),
    );
}
