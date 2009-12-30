<?
	/*********************************************************************
	 * Configuration
	 *********************************************************************/
	define("EZSQL_DB_USER", NERV_DB_USER);
	define("EZSQL_DB_PASSWORD", NERV_DB_PASS);
	define("EZSQL_DB_NAME", NERV_DB_NAME);
	define("EZSQL_DB_HOST", NERV_DB_HOST);

	define("EZSQL_VERSION","1.01");
	define("OBJECT","OBJECT",true);
	define("ARRAY_A","ARRAY_A",true);
	define("ARRAY_N","ARRAY_N",true);



	class Database {
		/*********************************************************************
		 * Constructor of the class
		 *********************************************************************/
		function Database ($dbuser, $dbpassword, $dbname, $dbhost)
		{
			$this->dbh = @mysql_connect($dbhost,$dbuser,$dbpassword);
			
			if ( ! $this->dbh )
			{
				$this->print_error("<ol><b>Error establishing a database connection!</b><li>Are you sure you have the correct user/password?<li>Are you sure that you have typed the correct hostname?<li>Are you sure that the database server is running?</ol>");
			}
			$this->select($dbname);
		}



		/*********************************************************************
		 * SELECT
		 * Function to select a database
		 *********************************************************************/
		function select ($db)
		{
			if ( !@mysql_select_db($db,$this->dbh))
			{
				$this->print_error("<ol><b>Error selecting database <u>$db</u>!</b><li>Are you sure it exists?<li>Are you sure there is a valid database connection?</ol>");
			}
		}



		/*********************************************************************
		 * PRINT_ERROR
		 * Print the database error.
		 *********************************************************************/
		function print_error($str = "")
		{
			if ( !$str ) $str = mysql_error();
			
			print "<blockquote><font face=arial size=2 color=ff0000>";
			print "<b>SQL/DB Error --</b> ";
			print "[<font color=000077>$str</font>]";
			print "</font></blockquote>";
		}




		/*********************************************************************
		 * QUERY
		 * Basic query function
		 *********************************************************************/
		function query($query, $output = OBJECT) 
		{
			$this->func_call = "\$db->query(\"$query\", $output)";
			$this->last_result = null;
			$this->col_info = null;

			$this->last_query = $query;

			$this->result = mysql_query($query,$this->dbh);

			if ( mysql_error() ) 
			{
				$this->print_error();
			}
			else
			{
				if ( $this->result )
				{
					$i=0;
					while ($i < @mysql_num_fields($this->result))
					{
						$this->col_info[$i] = @mysql_fetch_field($this->result);
						$i++;
					}

					$i=0;
					while ( $row = @mysql_fetch_object($this->result) )
					{ 
						$this->last_result[$i] = $row;
						
						$i++;
					}
					
					@mysql_free_result($this->result);

					if ( $i )
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			}
		}




		/*********************************************************************
		 * GET_VAR
		 *********************************************************************/
		function get_var($query=null,$x=0,$y=0)
		{
			$this->func_call = "\$db->get_var(\"$query\",$x,$y)";
			
			if ( $query ) 
			{
				$this->query($query);
			}
			
			if ( $this->last_result[$y] )
			{
				$values = array_values(get_object_vars($this->last_result[$y]));
			}
			
			return $values[$x]?$values[$x]:null;
		}
	
		// ==================================================================
		//	Get one row from the DB - see docs for more detail
		
		function get_row($query=null,$y=0,$output=OBJECT)
		{
			
			// Log how the function was called
			$this->func_call = "\$db->get_row(\"$query\",$y,$output)";
			
			// If there is a query then perform it if not then use cached results..
			if ( $query )
			{
				$this->query($query);
			}
	
			// If the output is an object then return object using the row offset..
			if ( $output == OBJECT )
			{
				return $this->last_result[$y]?$this->last_result[$y]:null;
			}
			// If the output is an associative array then return row as such..
			elseif ( $output == ARRAY_A )
			{
				return $this->last_result[$y]?get_object_vars($this->last_result[$y]):null;	
			}
			// If the output is an numerical array then return row as such..
			elseif ( $output == ARRAY_N )
			{
				return $this->last_result[$y]?array_values(get_object_vars($this->last_result[$y])):null;
			}
			// If invalid output type was specified..
			else
			{
				$this->print_error(" \$db->get_row(string query,int offset,output type) -- Output type must be one of: OBJECT, ARRAY_A, ARRAY_N ");	
			}
	
		}
	
		// ==================================================================
		//	Function to get 1 column from the cached result set based in X index
		// se docs for usage and info
	
		function get_col($query=null,$x=0)
		{
			
			// If there is a query then perform it if not then use cached results..
			if ( $query )
			{
				$this->query($query);
			}
			
			// Extract the column values
			for ( $i=0; $i < count($this->last_result); $i++ )
			{
				$new_array[$i] = $this->get_var(null,$x,$i);
			}
			
			return $new_array;
		}
	
		// ==================================================================
		// Return the the query as a result set - see docs for more details
		
		function get_results($query=null, $output = OBJECT)
		{
			
			// Log how the function was called
			$this->func_call = "\$db->get_results(\"$query\", $output)";
			
			// If there is a query then perform it if not then use cached results..
			if ( $query )
			{
				$this->query($query);
			}		
	
			// Send back array of objects. Each row is an object		
			if ( $output == OBJECT )
			{
				return $this->last_result; 
			}
			elseif ( $output == ARRAY_A || $output == ARRAY_N )
			{
				if ( $this->last_result )
				{
					$i=0;
					foreach( $this->last_result as $row )
					{
						
						$new_array[$i] = get_object_vars($row);
						
						if ( $output == ARRAY_N )
						{
							$new_array[$i] = array_values($new_array[$i]);
						}
	
						$i++;
					}
				
					return $new_array;
				}
				else
				{
					return null;	
				}
			}
		}
	
	
		// ==================================================================
		// Function to get column meta data info pertaining to the last query
		// see docs for more info and usage
		
		function get_col_info($info_type="name",$col_offset=-1)
		{
	
			if ( $this->col_info )
			{
				if ( $col_offset == -1 )
				{
					$i=0;
					foreach($this->col_info as $col )
					{
						$new_array[$i] = $col->{$info_type};
						$i++;
					}
					return $new_array;
				}
				else
				{
					return $this->col_info[$col_offset]->{$info_type};
				}
			
			}
			
		}
	
	
		// ==================================================================
		// Dumps the contents of any input variable to screen in a nicely
		// formatted and easy to understand way - any type: Object, Var or Array
	
		function vardump($mixed)
		{

			echo "<blockquote><font color=000090>";
			echo "<pre><font face=arial>";
			
			if ( ! $this->vardump_called )
			{
				echo "<font color=800080><b>ezSQL</b> (v".EZSQL_VERSION.") <b>Variable Dump..</b></font>\n\n";
			}
	
			print_r($mixed);	
			echo "\n\n<b>Last Query:</b> ".($this->last_query?$this->last_query:"NULL")."\n";
			echo "<b>Last Function Call:</b> " . ($this->func_call?$this->func_call:"None")."\n";
			echo "<b>Last Rows Returned:</b> ".count($this->last_result)."\n";
			echo "</font></pre></font></blockquote>";
			echo "\n<hr size=1 noshade color=dddddd>";
			
			$this->vardump_called = true;

		}
	
		// Alias for the above function	
		function dumpvars($mixed)
		{
			$this->vardump($mixed);	
		}
	
		// ==================================================================
		// Displays the last query string that was sent to the database & a 
		// table listing results (if there were any). 
		// (abstracted into a seperate file to save server overhead).
		
		function debug()
		{
			
			echo "<blockquote>";
	
			// Only show ezSQL credits once..
			if ( ! $this->debug_called )
			{
				echo "<font color=800080 face=arial size=2><b>ezSQL</b> (v".EZSQL_VERSION.") <b>Debug..</b></font><p>\n";
			}
			echo "<font face=arial size=2 color=000099><b>Query --</b> ";
			echo "[<font color=000000><b>$this->last_query</b></font>]</font><p>";
	
				echo "<font face=arial size=2 color=000099><b>Query Result..</b></font>";
				echo "<blockquote>";
				
			if ( $this->col_info )
			{
				
				// =====================================================
				// Results top rows
				
				echo "<table cellpadding=5 cellspacing=1 bgcolor=555555>";
				echo "<tr bgcolor=eeeeee><td nowrap valign=bottom><font color=555599 face=arial size=2><b>(row)</b></font></td>";
	
	
				for ( $i=0; $i < count($this->col_info); $i++ )
				{
					echo "<td nowrap align=left valign=top><font size=1 color=555599 face=arial>{$this->col_info[$i]->type} {$this->col_info[$i]->max_length}<br><font size=2><b>{$this->col_info[$i]->name}</b></font></td>";
				}
	
				echo "</tr>";
	
				// ======================================================
				// print main results
	
			if ( $this->last_result )
			{
	
				$i=0;
				foreach ( $this->get_results(null,ARRAY_N) as $one_row )
				{
					$i++;
					echo "<tr bgcolor=ffffff><td bgcolor=eeeeee nowrap align=middle><font size=2 color=555599 face=arial>$i</font></td>";
	
					foreach ( $one_row as $item )
					{
						echo "<td nowrap><font face=arial size=2>$item</font></td>";	
					}
	
					echo "</tr>";				
				}
	
			} // if last result
			else
			{
				echo "<tr bgcolor=ffffff><td colspan=".(count($this->col_info)+1)."><font face=arial size=2>No Results</font></td></tr>";			
			}
	
			echo "</table>";		
	
			} // if col_info
			else
			{
				echo "<font face=arial size=2>No Results</font>";			
			}
			
			echo "</blockquote></blockquote><hr noshade color=dddddd size=1>";
			
			
			$this->debug_called = true;
		}
	
	
	}
?>
