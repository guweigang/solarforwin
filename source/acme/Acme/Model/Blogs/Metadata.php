<?php
/**
 * 
 * Table metadata for the Acme_Model_Blogs model class.
 * 
 * This class is auto-generated by make-model; any changes you make will be
 * overwritten the next time you use make-model.  Modify the Acme_Model_Blogs
 * class instead of this one.
 * 
 */
class Acme_Model_Blogs_Metadata extends Acme_Sql_Model_Metadata
{
    public $table_name = 'blogs';
    
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
      'created' => array (
        'name' => 'created',
        'type' => 'timestamp',
        'size' => NULL,
        'scope' => NULL,
        'default' => NULL,
        'require' => false,
        'primary' => false,
        'autoinc' => false,
      ),
      'updated' => array (
        'name' => 'updated',
        'type' => 'timestamp',
        'size' => NULL,
        'scope' => NULL,
        'default' => NULL,
        'require' => false,
        'primary' => false,
        'autoinc' => false,
      ),
      'status' => array (
        'name' => 'status',
        'type' => 'varchar',
        'size' => 15,
        'scope' => NULL,
        'default' => NULL,
        'require' => false,
        'primary' => false,
        'autoinc' => false,
      ),
      'title' => array (
        'name' => 'title',
        'type' => 'varchar',
        'size' => 63,
        'scope' => NULL,
        'default' => NULL,
        'require' => true,
        'primary' => false,
        'autoinc' => false,
      ),
      'body' => array (
        'name' => 'body',
        'type' => 'mediumtext',
        'size' => NULL,
        'scope' => NULL,
        'default' => NULL,
        'require' => false,
        'primary' => false,
        'autoinc' => false,
      ),
      'author_id' => array (
        'name' => 'author_id',
        'type' => 'mediumint',
        'size' => NULL,
        'scope' => NULL,
        'default' => NULL,
        'require' => true,
        'primary' => false,
        'autoinc' => false,
      ),
    );
    
    public $index_info = array (
    );
}