<?php
/**
 *
 * Model class.
 *
 */
class Acme_Model_Blogs extends Acme_Sql_Model
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
        $metadata          = Solar::factory('Acme_Model_Blogs_Metadata');
        $this->_table_name = $metadata->table_name;
        $this->_table_cols = $metadata->table_cols;
        $this->_index_info = $metadata->index_info;
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
        // chain to parent
        parent::_setup();
        $this->_hasOne('summary');
        $this->_belongsTo('author');
        $this->_hasMany('taggings');
        $this->_hasManyThrough('tags', 'taggings');
        $this->_hasMany('comments', array(
            'order' => array('`id` DESC'),
        ));
        $this->_addFilter('status', 'validateInKeys',array(
            'draft' => '草稿',
            'public' => '发布',
        ));
        $model = Solar_Registry::get('model_catalog');
        //获取id=>name键值对
        $author = $model->authors->fetchPairs('id', 'name');
        $this->_addFilter('author_id', 'validateInKeys',$author);
    }
}
