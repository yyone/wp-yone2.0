<?php
class newCollapsArch {
	function phpArrayToJS($array, $name, $options) {
		/* generates javscript code to create an array from a php array */
		print "try { $name" .  "['catTest'] = 'test'; } catch (err) { $name = new Object(); }\n";

		if (!$options['expandYears'] && $options['expandMonths']) {
			$lastYear = -1;
			foreach ($array as $key => $value) {
			$parts = explode('-', $key);
			$label = $parts[0];
			$year = $parts[1];
			$moreparts = explode(':', $key);
			$widget = $moreparts[1];
			if ($year != $lastYear) {
				if ($lastYear>0)
					print  "';\n";
					print $name . "['$label-$year:$widget'] = '" . addslashes(str_replace("\n", '', $value));
					$lastYear=$year;
				} else {
					print addslashes(str_replace("\n", '', $value));
				}
			}
			print  "';\n";
		} else {
			foreach ($array as $key => $value) {
				print $name . "['$key'] = '" .  addslashes(str_replace("\n", '', $value)) . "';\n";
			}
		}
	}
}
include_once('newCollapsArchList.php');

function newCollapsArch($args='') {
	global $collapsArchItems;
	include('defaults.php');
	$options = wp_parse_args($args, $defaults);

	if (!is_admin()) {
		$expandSym = "<span class=\"expand_indicator\"></span>";
		$collapseSym = "<span class=\"collapse_indicator\"></span>";
		$options['expandSym'] = $expandSym; $options['collapseSym'] = $collapseSym;

		$archives = new_list_archives($options);
		extract($options);
		$archives .= "<li style='display:none'><script type=\"text/javascript\">\n// <![CDATA[\n";

		echo $archives;
		// now we create an array indexed by the id of the ul for posts
		newCollapsArch::phpArrayToJS($collapsArchItems, 'collapsItems', $options);
		echo "// ]]>\n</script></li>\n";

		echo "<script type=\"text/javascript\" src=\"". get_bloginfo('template_url'). "/js/collapsFunctions.min.js\"></script>\n";
	}
}
