<?php
/**
 * MediaWiki freenodeirc Extension
 * {{php}}{{Category:Extensions|freenodeirc}}
 * @package MediaWiki
 * @subpackage Extensions
 * @licence GNU General Public Licence 3.0 or later
 * @icarusfactor
 * irc.freenode.net #tulsalug #userspace
 * Daniel Yount aka icarusfactor 12/07/12
 */
 
define('FREENODEIRC_VERSION','0.5');
 
$wgExtensionFunctions[] = 'wfSetupFreenodeIRC';
$wgHooks['LanguageGetMagic'][] = 'wfFreenodeIRCLanguageGetMagic';



 
$wgExtensionCredits['parserhook'][] = array(
        'name'        => 'FreenodeIRC',
        'author'      => 'Daniel Yount - icarusfactor',
        'description' => 'freenodeirc extension',
        'url'         => 'http://www.mediawiki.org',
        'version'     => FREENODEIRC_VERSION
);
 
function wfFreenodeIRCLanguageGetMagic(&$magicWords,$langCode = 0) {
        $magicWords['freenodeirc'] = array(0,'freenodeirc');
        return true;
}
 
function wfSetupFreenodeIRC() {
        global $wgParser;
        $wgParser->setFunctionHook('freenodeirc','wfRenderFreenodeIRC');
        return true;
}
 
# Renders a table of all the individual month tables
function wfRenderFreenodeIRC( &$parser) {
        $output = '';

        #$parser->mOutput->mCacheTime = -1;
        $argv = array();
        foreach (func_get_args() as $arg) if (!is_object($arg)) {
                if (preg_match('/^(.+?)\\s*=\\s*(.+)$/',$arg,$match)) $argv[$match[1]]=$match[2];
        }
        if (isset($argv['channel']))    $locate  = $argv['channel']; else $locate = 'freenode';
        if (isset($argv['width']))      $width  = $argv['width'];  else $width  = '600';
        if (isset($argv['height']))     $height = $argv['height']; else $height = '400';


        
        $locate = str_replace( ' ' , '%20' , urlencode( $channel ) );

        $output =  '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://webchat.freenode.net/?channels=.'$channel'." width="'.$width.'" height="'.$height.'"></iframe>'; 

        return $parser->insertStripItem( $output, $parser->mStripState );
        #return $output;


}

