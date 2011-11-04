<?php

class Throttle
{
	public static $prefix = 'signin_throttle_for_';

	public static function increase($key)
	{
		$key = static::$prefix.$key;
		
		$failed = 1;
		if(Cache::has($key))
		{
			$tmp = Cache::get($key);
			$failed += $tmp[0];
		}
				
		Cache::put($key, array($failed, time()), 10);
	}
	
	public static function remove($key)
	{
		$key = static::$prefix.$key;
		if(Cache::has($key))
		{
			Cache::forget($key);
		}
	}
	
	public static function is_over($key)
	{
		$key = static::$prefix.$key;
		
		if(Cache::has($key))
		{
			$tmp = Cache::get($key);
			
			// if the time (in seconds) between attempts to access one account is less than the ^2 of failed attempts block the access
			
			if((time() - $tmp[1]) < ($tmp[0]*$tmp[0]))
			{
				return true;
			}
		}
		return false;
	}
}

?>