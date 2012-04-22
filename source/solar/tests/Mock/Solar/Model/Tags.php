<?php
/**
 * 
 * Example for testing a model of content "tags".
 * 
 * @category Solar
 * 
 * @package Mock_Solar
 * 
 * @author Paul M. Jones <pmjones@solarphp.com>
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 * @version $Id: Tags.php 4489 2010-03-02 15:34:14Z pmjones $
 * 
 */
class Mock_Solar_Model_Tags extends Solar_Sql_Model
{
    /**
     * 
     * Establish state of this object prior to _setup().
     * 
     * @return void
     * 
     */
    protected function _preSetup()
    {
        // chain to parent
        parent::_preSetup();
        
        // use metadata generated from make-model
        $metadata          = Solar::factory('Mock_Solar_Model_Tags_Metadata');
        $this->_table_name = $metadata->table_name;
        $this->_table_cols = $metadata->table_cols;
        $this->_index_info      = $metadata->index_info;
    }
    
    /**
     * 
     * Model-specific setup.
     * 
     * @return void
     * 
     */
    protected function _setup()
    {
        parent::_setup();
        $this->_hasMany('taggings');
        $this->_hasManyThrough('nodes', 'taggings');
    }
}