<?php
/**
 * This file is part of phpUnderControl.
 * 
 * PHP Version 5.2.0
 *
 * Copyright (c) 2007-2008, Manuel Pichler <mapi@manuel-pichler.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Manuel Pichler nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 * 
 * @category   QualityAssurance
 * @package    Data
 * @subpackage Logs
 * @author     Manuel Pichler <mapi@manuel-pichler.de>
 * @copyright  2007-2008 Manuel Pichler. All rights reserved.
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    SVN: $Id$
 * @link       http://www.phpundercontrol.org/
 */

require_once dirname( __FILE__ ) . '/../../AbstractTest.php';

/**
 * Abstract base class for log aggregators.
 * 
 * @category   QualityAssurance
 * @package    Data
 * @subpackage Logs
 * @author     Manuel Pichler <mapi@manuel-pichler.de>
 * @copyright  2007-2008 Manuel Pichler. All rights reserved.
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://www.phpundercontrol.org/
 */
abstract class phpucAbstractLogAggregatorTest extends phpucAbstractTest
{
    /**
     * List of test build results/logs.
     *
     * @type array<string>
     * @var array(string) $builds
     */
    protected $builds = array(
        'php-5.2.0'     =>  'php520', 
        'php-5.2.5'     =>  'php525', 
        'php-5.2.6RC2'  =>  'php526RC2'
    );
    
    /**
     * Returns an iterator with test log files.
     *
     * @param string $baseName The log file basename.
     * 
     * @return Iterator
     */
    protected function createValidFileIterator( $baseName )
    {
        $files = array();
        foreach ( $this->builds as $key => $build )
        {
            $files[$key] = sprintf( 
                '%s/phpunit/%s/%s.xml', 
                PHPUC_TEST_DATA, 
                $build,
                $baseName
            );
        }
        return new ArrayIterator( $files );
    }
    
    /**
     * Returns an iterator with test log files.
     *
     * @param string $baseName The log file basename.
     * 
     * @return Iterator
     */
    protected function createBrokenFileIterator( $baseName )
    {
        $files = array(
            'php-5.1.9'  =>  sprintf(
                '%s/phpunit/php519/%s.xml', 
                PHPUC_TEST_DATA, 
                $baseName
            )
        );
        foreach ( $this->builds as $key => $build )
        {
            $files[$key] = sprintf( 
                '%s/phpunit/%s/%s.xml', 
                PHPUC_TEST_DATA, 
                $build,
                $baseName
            );
        }
        return new ArrayIterator( $files );
    }
}