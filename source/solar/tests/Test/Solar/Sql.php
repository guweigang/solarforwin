<?php
/**
 * 
 * Factory class test.
 * 
 */
class Test_Solar_Sql extends Solar_Test {
    
    /**
     * 
     * Default configuration values.
     * 
     * @var array
     * 
     */
    protected $_Test_Solar_Sql = array(
    );
    
    /**
     * 
     * Test -- Constructor.
     * 
     */
    public function test__construct()
    {
        // we use `new` instead of Solar::factory() so that we get back the
        // factory class itself, not an adapter generated by the factory
        $actual = new Solar_Sql($this->_config);
        $expect = 'Solar_Sql';
        $this->assertInstance($actual, $expect);
    }
    
    /**
     * 
     * Test -- Disallow all calls to methods besides factory() and the existing support methods.
     * 
     */
    final public function test__call()
    {
        // we use `new` instead of Solar::factory() so that we get back the
        // factory class itself, not an adapter generated by the factory
        $obj = new Solar_Sql($this->_config);
        try {
            $obj->noSuchMethod();
            $this->fail('__call() should not work');
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
    }
    
    /**
     * 
     * Test -- Factory method for returning adapter objects.
     * 
     */
    public function testFactory()
    {
        $actual = Solar::factory('Solar_Sql');
        $expect = 'Solar_Sql_Adapter';
        $this->assertInstance($actual, $expect);
    }
}
