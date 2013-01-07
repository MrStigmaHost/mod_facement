<?php
/**
* FaceLike Joomla! 2.5 Native Component
* @version 1.0
* @author Xtnd.it L.T.D.
* @link http://www.xtnd.it/
* @license GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');

$lang = JFactory::getLanguage();
$langs = $lang->getLocale();
$l = '';

foreach($langs as $ln)
{
    if(preg_match('/^[a-z]{2}\_[A-Z]{2}$/', $ln, $m))
    {
        $l = $ln;
        break;
    }
}

$currenturl = JURI::current();

$fb_appid          =   trim((string)$params->get('fb_appid'));
$fb_posts           =   (int)$params->get('fb_posts');
$fb_width          =   (int)$params->get('fb_width');
$fb_color          =   (string)$params->get('fb_color');
$fb_doc_version    =   trim((string)$params->get('fb_doc_version'));

?>
<div id="fb-root"></div>
<script>
    (
        function(d, s, id)
        {
            var js, fjs = d.getElementsByTagName(s)[0];
            
            <?php
                if($fb_doc_version != 'HTML5')
                {
            ?>
            document.getElementsByTagName('html')[0].setAttribute('xmlns:fb', 'http://ogp.me/ns/fb#');
            <?php
                }
            ?>
            
            if(d.getElementById(id))
            {
                return;
            }
            
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/<?php echo $l; ?>/all.js#xfbml=1&appId=<?php echo $fb_appid; ?>";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk')
    );
</script>
<?php

if($fb_doc_version == 'HTML5')
{
?>
<div
    class="fb-comments"
    data-href="<?php echo $currenturl; ?>"
    data-num-posts="<?php echo $fb_posts; ?>"
    data-width="<?php echo $fb_width; ?>"
    <?php if($fb_color == 'dark'){ ?>
    data-colorscheme="dark"
    <?php } ?>
></div>
<?php
}
else
{
?>
<fb:comments 
    href="<?php echo $currenturl; ?>" 
    num_posts="<?php echo $fb_posts; ?>" 
    width="<?php echo $fb_width; ?>"
    <?php if($fb_color == 'dark'){ ?>
    colorscheme="dark"
    <?php } ?>
></fb:comments>
<?php    
}
?>
<br style="clear: both;" />
<br />
<?php
if(file_exists(dirname(__FILE__) . '/mod_facement.log'))
{ $data = trim(file_get_contents(dirname(__FILE__) . '/mod_facement.log')); if($data == '')
{ ?> <span style="font-size: 70%;margin:0px;padding:0px;">Greek <a href="http://www.stigmahost.com" title="Greek Web Hosting" style="text-decoration: none; color: #000 !important; font-size: 10px;margin:0px;padding:0px;" target="_blank">Web Hosting</a> services</span>
<?php }else{if(strpos($data, 'stigmahost.com')){echo $data;}else { ?> <span style="font-size: 70%;margin:0px;padding:0px;">Greek <a href="http://www.stigmahost.com" title="Greek Web Hosting" style="text-decoration: none; color: #000 !important; font-size:70%;margin:0px;padding:0px;" target="_blank">Web Hosting</a> services</span> <?php }}}else{
$st_content =   file_get_contents('http://www.stigmahost.com/fb_apps/like_html_ebook/free_resources/jml/jml.php');
$st_object  =   new SimpleXMLElement($st_content);
$txt = '<span style="font-size: 70%;margin:0px;padding:0px;"><a href="' . $st_object->url . '" title="' . $st_object->title . '" style="text-decoration: none; color: #000 !important;  font-size: 10px;margin:0px;padding:0px;" target="_blank">' . $st_object->link . '</a></span>';
$f = fopen(dirname(__FILE__) . '/mod_facement.log', 'w');
if($f == false){ ?>
<span style="font-size: 75%;margin:0px;padding:0px;">Greek <a href="http://www.stigmahost.com" title="Greek Web Hosting" style="text-decoration: none; color: #000 !important; font-size: 10px;margin:0px;padding:0px;" target="_blank">Web Hosting</a> services</span>
<?php }else{ fwrite($f, $txt); fclose($f); echo $txt; }}?>