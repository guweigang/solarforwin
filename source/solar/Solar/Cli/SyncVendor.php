<?php
/**
 *
 * Solar command to sync files and directories on windows only for xp, 2000 and 2003.
 *
 * @category Solar
 *
 * @package Solar_Cli
 *
 * @author Roy Gu <roy@solarphp.cn>
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 * @version $Id: SyncVendor.php 2010-07-17 20:34:00Z roygu $
 *
 *
 */
class Solar_Cli_SyncVendor extends Solar_Controller_Command
{
    /**
     *
     * The "StudlyCaps" version of the vendor name.
     *
     * @var string
     *
     */
    protected $_studly = null;

    /**
     *
     * The "lowercase-dashes" version of the vendor name.
     *
     * @var string
     *
     */
    protected $_dashes = null;

    /**
     *
     * The registered Solar_Inflect instance.
     *
     * @var Solar_Inflect
     *
     */
    protected $_inflect;

    /**
     *
     * Write out a series of dirs and symlinks for a new Vendor source.
     *
     * @param string $vendor The Vendor name.
     *
     * @return void
     *
     */
    protected function _exec($vendor = null)
    {
        // we need a vendor name, at least
        if (! $vendor) {
            throw $this->_exception('ERR_NO_VENDOR');
        }
        // build "foo-bar" and "FooBar" versions of the vendor name.
        $this->_inflect = Solar_Registry::get('inflect');
        $this->_dashes  = $this->_inflect->camelToDashes($vendor);
        $this->_studly  = $this->_inflect->dashesToStudly($this->_dashes);

        // the base system dir
        $system = Solar::$system;

        // update by Roy Gu 2010-07-11  -
        // sync files between include/Vendor <---> source/vendor/Vendor
        $is_win = strtolower(substr(PHP_OS, 0, 3)) == 'win';
        if ($is_win && php_uname('r') < 6) {
            $this->sync($this->links());
        } else {
            $this->_outln("Sorry about this! This command is only for windows XP, 2000 and 2003.");
            $this->_outln("=== Made by Solar Php in China ===");
            $this->_outln("... done.");
        }
    }
    public function links($vendor = NULL, $script = NULL, $system = NULL)
    {
        if(!$system) $system = Solar::$system;
        if(!$vendor) $vendor = $this->_studly;
        if(!$script) $script = $this->_dashes;
        $links = array();
        $links[] = array('src' =>  "docroot/public/{$vendor}/Controller/Bread",
                         'tgt' =>  "include/{$vendor}/Controller/Bread/Public",
                   );
        $links[] = array('src' =>  "docroot/public/{$vendor}/Controller/Page",
                         'tgt' =>  "include/{$vendor}/Controller/Page/Public",
                   );
        $links[] = array('src' => "include/Fixture/{$vendor}",
                         'tgt' => "source/{$script}/tests/Fixture/{$vendor}",
                   );
        $links[] = array('src' => "include/Mock/{$vendor}",
                         'tgt' => "source/{$script}/tests/Mock/{$vendor}",
                   );
        $links[] = array('src' => "include/Test/{$vendor}",
                         'tgt' => "source/{$script}/tests/Test/{$vendor}",
                   );
        if ('Solar' != $vendor) {
            try{
                $docroot_public_vendor = str_replace('/', DIRECTORY_SEPARATOR,
                                                     "{$system}/docroot/public/{$vendor}/App");
                // update by Roy Gu 2010-11-14
                if (file_exists($docroot_public_vendor) && is_dir($docroot_public_vendor)) {
                    $dir_iterator = new DirectoryIterator($docroot_public_vendor);
                    foreach ($dir_iterator as $fileinfo) {
                        if(!$fileinfo->isDot()){
                            $links[] = array('src' => "docroot/public/{$vendor}/App/{$fileinfo->getFilename()}",
                                             'tgt' => "include/{$vendor}/App/{$fileinfo->getFilename()}/Public",
                                       );
                        }
                    }
                }
            } catch (Exception $e) {
                $this->_outln('failed.');
                $this->_errln('        ' . $e->getMessage());
            }
        }
        if ('Solar' == $vendor) {
            array_shift($links);
            array_shift($links);
            $links[] = array('src' => "include/{$vendor}.php",
                             'tgt' => "source/{$script}/{$vendor}.php",
                       );
            $links[] = array('src' => "include/Test/{$vendor}.php",
                             'tgt' => "source/{$script}/tests/Test/{$vendor}.php",
                       );
        }
        $links[] = array('src' => "include/{$vendor}",
                         'tgt' => "source/{$script}/{$vendor}",
                   );
        return $links;
    }
    public function sync($links)
    {
        $system = Solar::$system;
        $this->_outln("Sync directories and files ... ");
        // set op equals sync
        Solar_Symlink::$op = 'sync';
        foreach ($links as $link) {
            try {
                extract($link);
                $tgt_source = str_replace('/', DIRECTORY_SEPARATOR, $system.'/'.$tgt);
                $err = Solar_Symlink::make($src, $tgt, $system);
                if (!$err) {
                    $this->_outln($src. ' -> '. $tgt);
                    $this->_outln("    done.");
                } else {
                    $this->_errln("    $err");
                }
            } catch (Exception $e) {
                $this->_outln('failed.');
            }
        }
        $this->_outln("Sync complete.");
        // done!
        $this->_outln("... done.");
        // sync end.
    }
}
