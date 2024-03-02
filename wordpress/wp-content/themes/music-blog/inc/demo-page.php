<?php
add_filter('advanced_import_welcome_message', 'music_blog_modify_welcome_message');
function music_blog_modify_welcome_message(){
  $message = '
   <div class="ai-header">
      <h1>
         '.esc_html__('Welcome to Music Blog Demo Import Page. What is the', 'music-blog').' <a href="'.esc_url('https://www.smarterthemes.com/').'" target="_blank">'.esc_html__('Difference Between Free & Pro Version.?', 'music-blog').'</a>
      </h1>
      <p>'.esc_html__( 'Thank you for choosing the Music Blog theme. This quick demo import setup will help you configure your new website like theme demo. It will install the required WordPress plugins, default content and tell you a little about Help &amp; Support options. It should only take less than 5 minutes.', 'music-blog' ).'</p>
   </div>
   ';

      return $welcome_msg;
}