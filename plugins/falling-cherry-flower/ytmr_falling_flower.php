<?php
/*
Plugin Name: Falling Cherry Flower
Plugin URI: https://php.dogrow.net/wordpressplugin/falling-cherry-flower/
Description: Falling cherry flower effect on the screen
Version: 1.0
Author: DOGROW.NET
Author https://php.dogrow.net/
License: GPL2
*/
////////////////////////////////////////////////////////////////////////
if(class_exists('YTMRFallingFlower')){
  $obj = new YTMRFallingFlower();
}
////////////////////////////////////////////////////////////////////////
class YTMRFallingFlower {
  private $m_shortcode_arg;
  //////////////////////////////////////////////////////////////////////
  public function __construct(){
    $this->m_shortcode_arg = array();
    //------------------------------------------------------------------
    add_shortcode('ytmr_falling_flower', array($this, 'proc_shortcode'));
    add_filter('widget_text', 'do_shortcode');
    //------------------------------------------------------------------
    add_action('wp_enqueue_scripts',    array($this, 'proc_add_script'));
    //------------------------------------------------------------------
    add_action( 'wp_footer', array($this, 'proc_end_of_body'), 9999);
    //------------------------------------------------------------------
    register_activation_hook(  __FILE__, array($this, 'proc_plugin_activate'));
    register_deactivation_hook(__FILE__, array($this, 'proc_plugin_deactivate'));
  }
  //////////////////////////////////////////////////////////////////////
  public function proc_plugin_activate(){
    // nothing todo for now
  }
  //////////////////////////////////////////////////////////////////////
  public function proc_plugin_deactivate(){
    // nothing todo for now
  }
  //////////////////////////////////////////////////////////////////////
  public function proc_add_script() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('ytmr_createjs_script',       plugins_url('js/createjs.js', __FILE__),            array('jquery'), '1.0.0', TRUE);
    wp_enqueue_script('ytmr_falling_flower_script', plugins_url('js/ytmr_falling_flower.js', __FILE__), array('jquery'), '1.0.0', TRUE);
  }
  //////////////////////////////////////////////////////////////////////
  public function proc_end_of_body(){
    $path_me = plugin_dir_path(__FILE__);
    $ary_prm = array('type'=>'cherryflower', 'speed'=>'2');
    //------------------------------------------------------------------
    // type
    if(isset($this->m_shortcode_arg['type'])){
      if(file_exists($path_me.'/img/'.$this->m_shortcode_arg['type'])){
        $ary_prm['type'] = $this->m_shortcode_arg['type'];
      }
    }
    //------------------------------------------------------------------
    // speed
    if(isset($this->m_shortcode_arg['speed'])){
      $speed = $this->m_shortcode_arg['speed'];
      if((0 <= $speed) && ($speed <= 5)){
        $ary_prm['speed'] = $speed;
      }
    }
    //------------------------------------------------------------------
    $img_dir = plugins_url('img/'.$ary_prm['type'], __FILE__).'/';
    //------------------------------------------------------------------
echo <<< EOM

<script>
jQuery(document).ready(function(){
  var obj = new GmEffect({
                  id: "ytmr_cherry_flower",
                  img_path: "{$img_dir}",
                  n_confetti_max: 150,
                  new_confetti_num: 1,
                  new_confetti_time: 600,
                  falling_speed: {$ary_prm['speed']}
  });
});
</script>

EOM;
  }
  //////////////////////////////////////////////////////////////////////
  // arg['type']  cherryflower / autumnleaf
  // arg['speed'] 0:very slow / 1:slow / 2:normal / 3:fast / 4:very fast
  public function proc_shortcode( $args ){
    $this->m_shortcode_arg = $args;
return <<< EOM
<canvas id="ytmr_cherry_flower" width="640" height="480" style="position: fixed;z-index: 999;top: 0;left: 0;pointer-events: none;"></canvas>
EOM;
  }
  //////////////////////////////////////////////////////////////////////
  public static function sub_get_dir($dir_base) {
    $ary_dir = array();
    $ary_entry = scandir($dir_base);
    foreach($ary_entry as $entry){
      if($entry == "."){
        continue;
      }
      if($entry == ".."){
        continue;
      }
      if(FALSE === is_dir($dir_base.$entry)){
        continue;
      }
      $ary_dir[] = $entry;
    }
    return $ary_dir;
  }
}   // end of class
?>
