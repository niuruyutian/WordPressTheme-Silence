<?php
/*
Template Name: 归档
*/
 get_header(); ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/css/archives.css" type="text/css" media="screen" /> 
<script src="<?php bloginfo('stylesheet_directory') ?>/js/archives.js"></script>
			<div class="singlecontent">
				<div class="article">
					<?php       
					        $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' );      
					        $year=0; $mon=0; $i=0; $j=0;      
					        $all = array();      
					        $output = '';      
					        while ( $the_query->have_posts() ) : $the_query->the_post();      
					            $year_tmp = get_the_time('Y');      
					            $mon_tmp = get_the_time('n');      
					            $y=$year; $m=$mon;      
					            if ($mon != $mon_tmp && $mon > 0) $output .= '</div></div>';      
					            if ($year != $year_tmp) { // 输出年份      
					                $year = $year_tmp;      
					                $all[$year] = array();      
					            }      
					            if ($mon != $mon_tmp) { // 输出月份      
					                $mon = $mon_tmp;      
					                array_push($all[$year], $mon);      
					                $output .= "<div class='archive-title' id='arti-$year-$mon'><h3>$year-$mon</h3><div class='archives archives-$mon' data-date='$year-$mon'>";      
					            }      
					            $output .= '<div class="brick"><a href="'.get_permalink() .'"><span class="time">'.get_the_time('n-d').'</span>'.get_the_title() .'</a></div>';      
					        endwhile;      
					        wp_reset_postdata();      
					        $output .= '</div></div>';      
					        echo $output;      
					     
					        $html = "";      
					        $year_now = date("Y");      
					        foreach($all as $key => $value){// 输出 左侧年份表      
					            $html .= "<li class='year' id='year-$key'><a href='#' class='year-toogle' id='yeto-$key'>$key</a><ul class='monthall'>";      
					            for($i=12; $i>0; $i--){      
					                if($key == $year_now && $i > $value[0]) continue;      
					                $html .= in_array($i, $value) ? ("<li class='month monthed' id='mont-$key-$i'>$i</li>") : ("<li class='month'>$i</li>");      
					            }      
					            $html .= "</ul></li>";   
					        }      
					    ?>     
				</div><!-- article -->
			</div><!-- singlecontent -->

			<div class="clear"></div>

<?php get_footer(); ?>