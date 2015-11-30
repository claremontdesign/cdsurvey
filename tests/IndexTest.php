<?php

class IndexTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testPackage()
    {
        $this->visit('/claremontdesign/einkspread')
             ->see('ClaremontDesign Einkspread.com Package.');
    }
}
