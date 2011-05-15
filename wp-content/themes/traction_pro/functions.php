<?php /* Display Twitter messages courtesy of Ricardo González Castro (http://rick.jinlabs.com/) */

function twitter_messages($username = '', $num = 1, $list = false, $update = true, $linked  = '#', $hyperlinks = true, $twitter_users = true, $encode_utf8 = false) {

	global $twitter_options;
	include_once(ABSPATH . WPINC . '/rss.php' );

	$messages = fetch_rss( 'http://twitter.com/statuses/user_timeline/'.$username.'.rss' );

	if ($list) echo '<ul class="twitter">';

	if ($username == '' ) {
		if ($list) echo '<li>';
		echo 'RSS not configured';
		if ($list) echo '</li>';
	} else {
			if ( empty($messages->items) ) {
				if ($list) echo '<li>';
				echo 'No public Twitter messages.';
				if ($list) echo '</li>';
			} else {
		  $i = 0;
				foreach ( $messages->items as $message ) {
					$msg = " ".substr(strstr($message['description'],': ' ), 2, strlen($message['description']))." ";
					if ($encode_utf8) $msg = utf8_encode($msg);
					$link = $message['link'];

					if ($list) echo '<li class="twitter-item">'; elseif ($num != 1) echo '<p class="twitter-message">';

					if ($hyperlinks) { $msg = hyperlinks($msg); }
					if ($twitter_users)	 { $msg = twitter_users($msg); }

					if ($linked != '' || $linked != false) {
				if ($linked == 'all' )	 {
				  $msg = '<a href="'.$link.'" class="twitter-link">'.$msg.'</a>';	 // Puts a link to the status of each tweet
				} else {
				  $msg = $msg . '<a href="'.$link.'" class="twitter-link">'.$linked.'</a>'; // Puts a link to the status of each tweet

				}
			 }

			 echo $msg;

		  if ($update) {
			 $time = strtotime($message['pubdate']);

			 if ( ( abs( time() - $time) ) < 86400 )
				$h_time = sprintf( __( '%s ago' ), human_time_diff( $time ) );
			 else
				$h_time = date(__( 'Y/m/d' ), $time);

			 echo sprintf( __( '%s', 'twitter-for-wordpress' ),' <a href="'.$link.'" class="twitter-timestamp"><abbr title="' . date(__( 'Y/m/d H:i:s' ), $time) . '">' . $h_time . '</abbr></a>' );
			}

					if ($list) echo '</li>'; elseif ($num != 1) echo '</p>';

					$i++;
					if ( $i >= $num ) break;
				}
			}
		}
		if ($list) echo '</ul>';
	}

// Link discover stuff
function hyperlinks($text) {
	 $text = preg_replace( '/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
	 $text = preg_replace( '/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
	 $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
	 $text = preg_replace( '/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
	 return $text;
}
function twitter_users($text) {
		 $text = preg_replace( '/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
		 return $text;
}

/* Your custom functions below this line
------------------------------------------------------------ */
?>