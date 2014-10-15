<?php
function autoload($classname)
{
	$file = '../../modele/' . $classname . '.php';
  if (file_exists($file))
  {
    require $file;
  }
  else
  {
  	$file = '../../modele/sql/' . $classname . '.php';
  	if (file_exists($file))
  	{
  		require $file;
  	}
  	else
  	{
  		$file = 'modele/sql/' . $classname . '.php';
  		if (file_exists($file))
  		{
  			require $file;
  		}
  		else 
  		{
  			$file = 'modele/' . $classname . '.php';
  			if (file_exists($file))
  			{
  				require $file;
  			}
  			else
  			{
  				$file = '../modele/sql/' . $classname . '.php';
  				if (file_exists($file))
  				{
  					require $file;
  				}
  				else
  				{
  					$file = '../modele/' . $classname . '.php';
  					if (file_exists($file))
  					{
  						require $file;
  					}
  					else
  					{
  						$file = $classname . '.php';
  						if (file_exists($file))
  						{
  							require $file;
  						}
  						else
  						{
  							$file = '../' . $classname . '.php';
  							if (file_exists($file))
  							{
  								require $file;
  							}
  						}
  					}
  				}
  			}
  		}
  	}
  }
}

spl_autoload_register('autoload');