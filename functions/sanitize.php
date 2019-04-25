<!-- sanitization removes any illegal character from data hence ensuring security -->
<?php  

	function escape($string){

// ent_quotes escape single and double quotes
		// UTF_8 is a character encoder
			return htmlentities($string,ENT_QUOTES,'utf-8');
	}

