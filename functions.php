<?php
 {
    // This theme supports a variety of post formats.
    add_theme_support( 'post-formats', array( 'aside','status'));

   // This theme uses wp_nav_menu() in one location.
    register_nav_menu( 'primary', __( 'Menu', 'Silence' ) );
    
    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 780, 9999 ); // Unlimited height, soft crop
}

function myjs() {
        wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-1.8.1.min.js', false, false , false );
    }
add_action( 'wp_enqueue_scripts', 'myjs' );
function mystyle() {
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, false , false );
}
add_action( 'wp_enqueue_scripts', 'mystyle' );
/*   more */
add_filter('the_content_more_link', 'cp_more_link');
function cp_more_link( $more_link ){
    return "<div class='readmore'>$more_link</div>";
}
/*后台控制*/
add_action('admin_menu', 'mytheme_page');

function mytheme_page (){
 
    if ( count($_POST) > 0 && isset($_POST['mytheme_settings']) ){
 
        $options = array ('logotitle','description','analytics','bannercolor','customstyle','footertext');
        foreach ( $options as $opt ){
 
            delete_option ( 'mytheme_'.$opt, $_POST[$opt] );
 
            add_option ( 'mytheme_'.$opt, $_POST[$opt] );   
 
        }
 
    }

 
    add_theme_page(__('主题选项'), __('主题选项'), 'edit_themes', basename(__FILE__), 'mytheme_settings');
}
function mytheme_settings(){?>
 

<div class="wrap">
<div class="childwrap">
 
<h2>主题选项</h2>
 
<form method="post" action="">
 
    <fieldset>
 
    <legend><strong>Silence<strong></legend>
 
        <table class="form-table">
 
            <tr><td>
 
                <textarea name="description" id="description" rows="2" cols="70"><?php echo get_option('mytheme_description'); ?></textarea>
 
                <em>网站描述（Meta Description），针对搜索引擎设置的网页描述。</em>
 
            </td></tr>
            
            <tr><td>
 
                <textarea name="customstyle" id="customstyle" rows="7" cols="70"><?php echo get_option('mytheme_customstyle'); ?></textarea>
 
                <em>自定义CSS</em>
 
            </td></tr>
            <tr><td>
 
                <textarea name="footertext" id="footertext" rows="2" cols="70"><?php echo stripslashes(get_option('mytheme_footertext')); ?></textarea>
 
                <em>Footer文字(如果你愿意保留我的版权链接作为对我的支持，我会很开心)</em>
 
            </td></tr>

        </table>
 
    </fieldset>
 
 
 
    <fieldset>
 
    <legend><strong>统计代码添加</strong></legend>
 
        <table class="form-table">
 
            <tr><td>
 
                <textarea name="analytics" id="analytics" rows="5" cols="70"><?php echo stripslashes(get_option('mytheme_analytics')); ?></textarea>
 
            </td></tr>
 
        </table>
 
    </fieldset>
 
  
 
    <p class="submit">
 
        <input type="submit" name="Submit" class="button-primary" value="保存设置" />
 
        <input type="hidden" name="mytheme_settings" value="save" style="display:none;" />
 
    </p>
 
 
 
</form>
 
</div>
</div>
 
<?php }


 /*移除字体*/
function remove_open_sans() {
wp_deregister_style( 'open-sans' );
wp_register_style( 'open-sans', false );
wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );

/*缩略图*/
function post_thumbnail( $width = 768,$height = 500 ){
 global $post;
 if( has_post_thumbnail() ){ //如果有缩略图，则显示缩略图
 $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
 $post_timthumb = '<img src="'.get_bloginfo("template_url").'/timthumb/timthumb.php?src='.$timthumb_src[0].'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" class="thumb" />';
 echo $post_timthumb;
 }
}

/*底栏*/

function windyflat_widgets_init() {
    register_sidebar( array(
        'name' => __( '第一底边栏', 'windyflat' ),
        'id' => 'sidebar-1',
        'description' => __( '左边的小工具', 'windyflat' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( '第二底边栏', 'windyflat' ),
        'id' => 'sidebar-2',
        'description' => __( '中间的小工具', 'windyflat' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ) );

}
add_action( 'widgets_init', 'windyflat_widgets_init' );



 /*** AJAX评论 ***/

// 评论回复构架
function themecomment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
        global $commentcount;
        if(!$commentcount) {
           $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
           $cpp = get_option('comments_per_page');
           $commentcount = $cpp * $page;
        }
        /* 区分普通评论和Pingback */
        switch ($pingtype=$comment->comment_type) {
        case 'pingback' : /* 标识Pingback */
        case 'trackback' : /* 标识Trackback */

?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard pingback">
            <cite class="fn zborder_pingback"><?php comment_date('Y-m-d') ?> &raquo; <?php comment_author_link(); ?></cite>
        </div>
    </div>

    <?php
        break;
        /* 标识完毕 */
        default : /* 普通评论部分 */ 
        if(!$comment->comment_parent){ ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<div class="clear"></div>
<article id="comment-<?php comment_ID(); ?>" class="comment-body">
<section class="comment-content">
<header class="comment-header">
<span class="comment-author"><?php printf( __( '<cite class="fn">%s</cite>'), get_comment_author_link() ); ?>
<span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span>
</header>
<div class="commenttext">
    <?php comment_text(); ?>
</div>
<span class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复')))) ?></span></span>
</section>  
</article>
<div class="clear"></div>
<?php }else{?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<article id="comment-<?php comment_ID(); ?>" class="comment-body comment-children-body">

<section class="comment-content">
<header class="comment-header">
<span class="comment-author"><?php $parent_id = $comment->comment_parent; $comment_parent = get_comment($parent_id); printf(__('%s'), get_comment_author_link()) ?> 回复 <a href="<?php echo "#comment-".$parent_id;?>" title="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $comment_parent->comment_content)), 0, 100,"..."); ?>"><?php echo $comment_parent->comment_author;?></a></span>
<span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span>
</header>
<div class="clear"></div>
<div class="commenttext">
    <?php comment_text(); ?>
</div>
<span class="floor"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复')))) ?></span>
</section>  
</article>
<div class="clear"></div>
<?php }
break; /* 普通评论标识完毕 */
    }
}

//comment_popup_links只统计评论数
if (function_exists('wp_list_comments')) {
    // comment count
    add_filter('get_comments_number', 'comment_count', 0);
    function comment_count( $commentcount ) {
        global $id;
        $_commnets = get_comments('post_id=' . $id);
        $comments_by_type = &separate_comments($_commnets);
        return count($comments_by_type['comment']);
    }
}


function ajax_comment_scripts() {
    global $pagenow;
    if(is_singular()){
        wp_enqueue_script( 'base', get_template_directory_uri() . '//js/comments-ajax.js', array(), '1.00', true);
        wp_localize_script('base', 'bigfa_Ajax_Url', array(       
        "um_ajaxurl" => admin_url('admin-ajax.php')
        ));
    }
}
add_action('wp_enqueue_scripts', 'ajax_comment_scripts');
add_action('wp_ajax_nopriv_ajax_comment', 'ajax_comment');
add_action('wp_ajax_ajax_comment', 'ajax_comment');
function ajax_comment(){
    global $wpdb;
    $comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
    $post = get_post($comment_post_ID);
    if ( empty($post->comment_status) ) {
        do_action('comment_id_not_found', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    }
    $status = get_post_status($post);
    $status_obj = get_post_status_object($status);
    if ( !comments_open($comment_post_ID) ) {
        do_action('comment_closed', $comment_post_ID);
        ajax_comment_err(__('Sorry, comments are closed for this item.'));
    } elseif ( 'trash' == $status ) {
        do_action('comment_on_trash', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    } elseif ( !$status_obj->public && !$status_obj->private ) {
        do_action('comment_on_draft', $comment_post_ID);
        ajax_comment_err(__('Invalid comment status.'));
    } elseif ( post_password_required($comment_post_ID) ) {
        do_action('comment_on_password_protected', $comment_post_ID);
        ajax_comment_err(__('Password Protected'));
    } else {
        do_action('pre_comment_on_post', $comment_post_ID);
    }
    $comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
    $comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
    $comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
    $comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
    $user = wp_get_current_user();
    if ( $user->exists() ) {
        if ( empty( $user->display_name ) )
            $user->display_name=$user->user_login;
        $comment_author       = $wpdb->escape($user->display_name);
        $comment_author_email = $wpdb->escape($user->user_email);
        $comment_author_url   = $wpdb->escape($user->user_url);
        $user_ID              = $wpdb->escape($user->ID);
        if ( current_user_can('unfiltered_html') ) {
            if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
                kses_remove_filters();
                kses_init_filters();
            }
        }
    } else {
        if ( get_option('comment_registration') || 'private' == $status )
            ajax_comment_err(__('Sorry, you must be logged in to post a comment.'));
    }
    $comment_type = '';
    if ( get_option('require_name_email') && !$user->exists() ) {
        if ( 6 > strlen($comment_author_email) || '' == $comment_author )
            ajax_comment_err( __('Error: please fill the required fields (name, email).') );
        elseif ( !is_email($comment_author_email))
            ajax_comment_err( __('Error: please enter a valid email address.') );
    }
    if ( '' == $comment_content )
        ajax_comment_err( __('Error: please type a comment.') );
    $dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
    if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
    $dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
    if ( $wpdb->get_var($dupe) ) {
        ajax_comment_err(__('Duplicate comment detected; it looks as though you&#8217;ve already said that!'));
    }
    if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) {
        $time_lastcomment = mysql2date('U', $lasttime, false);
        $time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
        $flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
        if ( $flood_die ) {
            ajax_comment_err(__('You are posting comments too quickly.  Slow down.'));
        }
    }
    $comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
    $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

    $comment_id = wp_new_comment( $commentdata );

    $comment = get_comment($comment_id);
    do_action('set_comment_cookies', $comment, $user);
    $comment_depth = 1;
    $tmp_c = $comment;
    while($tmp_c->comment_parent != 0){
        $comment_depth++;
        $tmp_c = get_comment($tmp_c->comment_parent);
    }
    $GLOBALS['comment'] = $comment; //your comments here    edit start 
        if(!$comment->comment_parent){
        //以下是評論式樣, 不含 "回覆". 要用你模板的式樣 copy 覆蓋.
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<article id="comment-<?php comment_ID(); ?>" class="comment-body comment-children-body">

<section class="comment-content">
<header class="comment-header">
<span class="comment-author"><?php $parent_id = $comment->comment_parent; $comment_parent = get_comment($parent_id); printf(__('%s'), get_comment_author_link()) ?> 回复 <a href="<?php echo "#comment-".$parent_id;?>" title="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $comment_parent->comment_content)), 0, 100,"..."); ?>"><?php echo $comment_parent->comment_author;?></a></span>
<span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span>
</header>
<div class="commenttext">
    <?php comment_text(); ?>
</div>
</section>  
</article>
<div class="clear"></div>

<?php }else{?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<div class="clear"></div>
<article id="comment-<?php comment_ID(); ?>" class="comment-body">
<section class="comment-content">
<header class="comment-header">
<span class="comment-author"><?php printf( __( '<cite class="fn">%s</cite>'), get_comment_author_link() ); ?>
<span class="datetime"><?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span>
</header>
<div class="commenttext">
    <?php comment_text(); ?>
</div>
</section>  
</article>
<div class="clear"></div>

        <?php } die();

}
function ajax_comment_err($a) {
    header('HTTP/1.0 500 Internal Server Error');
    header('Content-Type: text/plain;charset=UTF-8');
    echo $a;
    exit;
}

//Comments Ajax end.

/*///////////////////////*/
add_action('wp_ajax_nopriv_ajax_comment_page_nav', 'ajax_comment_page_nav');
add_action('wp_ajax_ajax_comment_page_nav', 'ajax_comment_page_nav');
function ajax_comment_page_nav(){
    global $post,$wp_query, $wp_rewrite;
    $postid = $_POST["um_post"];
    $pageid = $_POST["um_page"];
    $comments = get_comments('post_id='.$postid);
    $post = get_post($postid);
    if( 'desc' != get_option('comment_order') ){
        $comments = array_reverse($comments);
    }
    $wp_query->is_singular = true;
    $baseLink = '';
    if ($wp_rewrite->using_permalinks()) {
        $baseLink = '&base=' . user_trailingslashit(get_permalink($postid) . 'comment-page-%#%', 'commentpaged');
    }
    echo '<ol class="commentlist">';
    wp_list_comments('type=comment&callback=themecomment&max_depth=500&page=' . $pageid . '&per_page=' . get_option('comments_per_page'), $comments);//注意修改mycomment这个callback
    echo '</ol>';
    echo '<div id="commentnav" data-post-id="'.$postid.'">';
    paginate_comments_links('current=' . $pageid . '&prev_text=« Prev&next_text=Next »');
    echo '</div>';
    die;
}?>
